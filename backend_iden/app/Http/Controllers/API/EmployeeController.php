<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function getTeamMembers($manager_id)
    {
        // Fetch the manager's information
        $manager = Employee::find($manager_id);

        // Check if manager exists
        if (!$manager) {
            return response()->json(['error' => 'Manager not found'], 404);
        }

        // Fetch employees who report to the manager
        $teamMembers = Employee::where('manager_id', $manager_id)->get();

        // Return both manager and team members in a single response
        return response()->json([
            'manager' => $manager,
            'team_members' => $teamMembers
        ]);
    }
}
