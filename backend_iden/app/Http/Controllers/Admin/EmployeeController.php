<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Position;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Employee access|Employee create|Employee edit|Employee delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Employee edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Employee delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::latest()->get();
        // return view('employee.index', ['employees' => $employees]);

        $employees = Employee::with(['position', 'department'])->get();
        return view('employee.index', compact('employees'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'staff_id' => 'required|unique:employees',
        //     'full_name' => 'required',
        //     'email' => 'required|email|unique:employees',
        //     'password' => 'required|confirmed',
        //     'dob' => 'required|date',
        //     'position_id' => 'required|integer',
        //     'department_id' => 'required|integer',
        // ]);

        $employee = Employee::create([
            'staff_id' => $request->staff_id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dob' => $request->dob,
            'joined_date' => $request->joined_date,
            'entitled_calendar' => $request->entitled_calendar,
            'reporting_line' => $request->reporting_line,
            'profile_image' => $request->profile_image,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
        ]);

        $employee->syncRoles($request->roles);

        return redirect()->route('admin.employee.index')->withSuccess('Employee created successfully!');

        // return redirect()->back()->withSuccess('Employee created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // $validated = $request->validate([
        //     'staff_id' => 'required',
        //     'full_name' => 'required',
        //     'email' => 'required',
        //     'dob' => 'required',
        //     'position_id' => 'required',
        //     'department_id' => 'required',
        // ]);

        // if ($request->password != null) {
        //     $request->validate([
        //         'password' => 'required|confirmed'
        //     ]);
        //     $validated['password'] = bcrypt($request->password);
        // }

        // $employee->update($validated);


        // $employee->syncRoles($request->roles);
        $Em = Employee::where('id', $employee->id)->first();
        $Em->update($request->all());
        
        return redirect()->back()->withSuccess($Em);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        // return redirect()->back()->withSuccess('Employee deleted successfully!');
        return redirect()->route('admin.employee.index')->withSuccess('Employee deleted successfully!');

    }
}
