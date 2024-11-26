<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user   = Employee::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }


    public function index(Request $request)
    {

        $user = $request->user(); // Get the authenticated user
        $permissions = $user->permissions;
        $roles = $user->roles;

        // Fetch team members if the authenticated user is a manager
        // Use eager loading to load the position, department, and manager data
        $teamMembers = Employee::with(['position', 'department', 'manager'])
            ->where('manager_id', $user->id)
            ->get();
        $teamCount = Employee::where('manager_id', $user->id)->count();

        return response()->json([
            'message' => 'Login success',
            'data' => $user,
            'role' => $roles,
            'permission' => $permissions,
            'team_members' => $teamMembers, // Include team members in the response
            'team_count' => $teamCount // Include team count in the response
        ]);
    }
    public function getTeam(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        $permissions = $user->permissions;
        $roles = $user->roles;

        // Fetch the department ID of the authenticated user
        $userDepartmentId = $user->department_id;

        // Fetch employees who belong to the same department as the authenticated user
        // Exclude the logged-in user from the list (if needed)
        $teamMate = Employee::with(['position', 'department', 'manager'])
            ->where('department_id', $userDepartmentId)
            ->where('id', '!=', $user->id) // Exclude the logged-in user from the team members (optional)
            ->get();

        // Get the count of employees in the same department
        $teamCount = $teamMate->count();

        return response()->json([
            'message' => 'Login success',
            'data' => $user,  // User info
            'role' => $roles,
            'permission' => $permissions,
            'teams' => $teamMate,  // Team members in the same department
            'team_count' => $teamCount  // Total team count in the same department
        ]);
    }


    // ====>get Team Members by id<========
    public function getTeamMemberById(Request $request, $id)
    {
        $user = $request->user(); // Get the authenticated user

        // Fetch the department ID of the authenticated user
        $userDepartmentId = $user->department_id;

        // Fetch the specific team member by ID from the same department
        $teamMember = Employee::with(['position', 'department', 'manager'])
            ->where('id', $id)
            ->where('department_id', $userDepartmentId) // Ensure the member is from the same department
            ->first();

        if (!$teamMember) {
            return response()->json(['message' => 'Team member not found'], 404);
        }

        return response()->json([
            'message' => 'Team member found',
            'team_member' => $teamMember // Return the specific team member details
        ]);
    }
}
