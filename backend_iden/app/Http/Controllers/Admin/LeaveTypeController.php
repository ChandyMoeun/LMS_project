<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\User; // Assuming you have a User model
use Auth;

class LeaveTypeController extends Controller
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


        $leaveTypes = LeaveType::with(['employee.roles', 'employee.department', 'employee.position'])->get();
        return view('leavetype.index', compact('leaveTypes'));
    }

    public function create()
    {
        // Fetch all employees to display in the dropdown
        $employees = Employee::all();
        return view('leavetype.new', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'leave_name' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'requires_attachment' => 'sometimes|boolean',
            'auto_increase_entitlement' => 'sometimes|boolean',
            'increase_rate' => 'required|integer',
        ]);

        // Create the new LeaveType
        LeaveType::create([
            'leave_name' => $request->leave_name,
            'employee_id' => $request->employee_id,
            'requires_attachment' => $request->has('requires_attachment') ? 1 : 0,
            'auto_increase_entitlement' => $request->has('auto_increase_entitlement') ? 1 : 0,
            'increase_rate' => $request->increase_rate,
        ]);

        // Redirect back to the leave type index
        return redirect()->route('admin.leavetype.index')->with('success', 'Leave type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $leaveTypes = LeaveType::findOrFail($id);
        $employees = Employee::all();
        return view('leavetype.edit', compact('leaveTypes', 'employees'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'leave_name' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'requires_attachment' => 'sometimes|boolean',
            'auto_increase_entitlement' => 'sometimes|boolean',
            'increase_rate' => 'required|integer',
        ]);

        // Find the LeaveType by ID or fail
        $leaveType = LeaveType::findOrFail($id);

        // Update the LeaveType with new data
        $leaveType->update([
            'leave_name' => $request->leave_name,
            'employee_id' => $request->employee_id,
            'requires_attachment' => $request->has('requires_attachment') ? 1 : 0,
            'auto_increase_entitlement' => $request->has('auto_increase_entitlement') ? 1 : 0,
            'increase_rate' => $request->increase_rate,
        ]);

        // Redirect back to the leave type index with a success message
        return redirect()->route('admin.leavetype.index')->with('success', 'Leave type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the LeaveType by ID or fail
        $leaveType = LeaveType::findOrFail($id);
        // Delete the LeaveType
        $leaveType->delete();
        // Redirect back to the leave type index with a success message
        return redirect()->route('admin.leavetype.index')->with('success', 'Leave type deleted successfully.');
    }
}
