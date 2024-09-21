<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Position;
use App\Models\Department;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Employee access|Employee create|Employee edit|Employee delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Employee edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Employee delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //======> Displays the resource listing form for the current user <=====
        $employees = Employee::with(['position', 'department', 'manager'])->get();
        $totalEmployees = $employees->count();  // Get the total number of employees
        return view('employee.index', compact('employees', 'totalEmployees'));
    }

    public function EmployeeDashboard()
    {
        // Fetch the total number of employees
        $totalEmployees = Employee::count();

        // Optionally, fetch all employees if needed for the view
        $employees = Employee::all();

        // Pass data to the view
        return view('dashboard', compact('employees', 'totalEmployees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::get();
        $positions = Position::all(); // Fetch all positions
        $departments = Department::all(); // Fetch all departments
        $roles = Role::all(); // Assuming you have a Role model

        // return view('employee.new', ['roles' => $roles]);
        return view('employee.new', compact('positions', 'departments', 'roles'));
    }


    // Fetch the employee with the given ID
    public function show(Employee $employee)
    {
        // Get the current manager's ID
        $managerId = Auth::id(); // Or any specific manager ID

        // Fetch employees under the current manager
        $employees = Employee::where('manager_id', $managerId)
            ->with('position', 'department') // Include positions and departments
            ->get();

        // Fetch all positions
        $positions = Position::all();
        // Fetch all departments
        $departments = Department::all();
        // Fetch all roles
        $roles = Role::all();

        return view('employee.profile.index', [
            'employee' => $employee,
            'roles' => $roles,
            'positions' => $positions,
            'departments' => $departments,
        ]);


        // return view('employee.profile.index', ['employee' => $employee, 'roles' => $roles, 'positions' => $positions, 'departments' => $departments, 'manager' => $manger]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'staff_id' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:8|confirmed',
            'dob' => 'required|date',
            'joined_date' => 'required|date',
            'entitled_date' => 'required|date|after_or_equal:joined_date',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id'
        ]);

        $employee = new Employee();
        $employee->staff_id = $request->staff_id;
        $employee->full_name = $request->full_name;
        $employee->gender = $request->gender;
        $employee->email = $request->email;
        $employee->password = bcrypt($request->password);
        $employee->dob = $request->dob;
        $employee->joined_date = $request->joined_date;
        $employee->entitled_date = $request->entitled_date;
        $employee->position_id = $request->position_id;
        $employee->department_id = $request->department_id;

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $employee->profile = $filename;
        }

        $employee->save();
        $employee->roles()->sync($request->roles);

        return redirect()->route('admin.employee.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all(); // Fetch all positions
        $departments = Department::all(); // Fetch all departments
        $roles = Role::get();
        $employee->roles;

        return view('employee.edit', ['employee' => $employee, 'roles' => $roles, 'positions' => $positions, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'staff_id' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'password' => 'nullable|confirmed|min:6',
            'dob' => 'required|date',
            'joined_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'roles' => 'array'
        ]);

        $employee->staff_id = $request->staff_id;
        $employee->full_name = $request->full_name;
        $employee->gender = $request->gender;
        $employee->email = $request->email;

        if ($request->filled('password')) {
            $employee->password = bcrypt($request->password);
        }

        $employee->dob = $request->dob;
        $employee->joined_date = $request->joined_date;
        $employee->position_id = $request->position_id;
        $employee->department_id = $request->department_id;

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $employee->profile = $filename;
        }

        $employee->save();
        $employee->roles()->sync($request->roles);

        return redirect()->route('admin.employee.index')->with('success', 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employee.index')->withSuccess('Employee deleted successfully!');
    }
}
