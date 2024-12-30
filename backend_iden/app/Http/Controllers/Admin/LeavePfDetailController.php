<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRequest; // Assuming you have a LeaveRequest model
use App\Models\LeaveType; // Assuming you have a LeaveType model
use App\Models\Position; // Assuming you have a Position model
use Auth;


class LeavePfDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('role_or_permission:LeaveType access|LeaveType create|LeaveType edit|LeaveType delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:LeaveType create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:LeaveType edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:LeaveType delete', ['only' => ['destroy']]);
    }

    public function index()

    {
        $employees = Employee::all();
        $totalEmployees = $employees->count();

        $leaveRequests = LeaveRequest::all();
        $totalLeaveRequests = $leaveRequests->count();

        // Pass both sets of data to the view
        return view('employee.more.index', compact('employees', 'totalEmployees', 'leaveRequests', 'totalLeaveRequests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        $leaveRequests = LeaveRequest::where('employee_id', $id)->get();
        $leaveTypes = LeaveType::all();
        $positions = Position::all();

        return view('employee.more.index', compact('employee', 'leaveRequests', 'leaveTypes', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function employeeProfile(string $id)
    // {
    //     $employee = Employee::find($id);

    //     return view('employee.profile.index', ['employee' => $employee]);
    // }
}
