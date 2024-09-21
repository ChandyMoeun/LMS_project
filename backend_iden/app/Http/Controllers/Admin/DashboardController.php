<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRequest; // Assuming you have a LeaveRequest model
use App\Models\LeaveType; // Assuming you have a LeaveType model
use App\Models\Position; // Assuming you have a Position model

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all employees with their profiles
        $employees = Employee::all();
        $totalEmployees = $employees->count();

        // Fetch all leave requests and eager load the related employee data (including profile)
        $leaveRequests = LeaveRequest::with('employee')->get();
        $totalLeaveRequests = $leaveRequests->count();

        // Pass both sets of data to the view
        return view('dashboard', compact('employees', 'totalEmployees', 'leaveRequests', 'totalLeaveRequests'));
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
    // public function show($id)
    // {
    //     // Fetch leave request by its ID
    //     $leaveRequest = LeaveRequest::findOrFail($id);

    //     // Return the data as JSON
    //     return response()->json([
    //         'employee_name' => $leaveRequest->employee->name ?? 'N/A',
    //         'leave_type' => $leaveRequest->leaveType->name ?? 'N/A',
    //         'start_date' => $leaveRequest->start_date,
    //         'end_date' => $leaveRequest->end_date,
    //         'status' => $leaveRequest->status ?? 'N/A',
    //         'reason' => $leaveRequest->reason ?? 'N/A',
    //     ]);
    //     return view('admin.more.show', compact('employee', 'leaveRequests', 'leaveTypes', 'positions'));
    // }


    // public function more( $id){
    //     $employee = Employee::find($id);
    //     $leaveRequests = LeaveRequest::where('employee_id', $id)->get();
    //     $leaveTypes = LeaveType::all();
    //     $positions = Position::all();

    //     return view('employee.more.index', compact('employee', 'leaveRequests', 'leaveTypes', 'positions'));
    // }

    // // =====>approve request<======
    // public function approve(LeaveRequest $leaveRequest)
    // {
    //     $leaveRequest->status = 'approved';
    //     $leaveRequest->approved_by = auth()->user()->id; // Store the ID of the user who approved the request
    //     $leaveRequest->save();

    //     return redirect()->route('resources.dashboard')->with('success', 'Leave request approved successfully.');
    // }

    // // =====>reject request<======
    // public function reject(LeaveRequest $leaveRequest)
    // {
    //     $leaveRequest->status = 'rejected';
    //     $leaveRequest->rejected_by = auth()->user()->id; // Store the ID of the user who rejected the request
    //     $leaveRequest->save();

    //     return redirect()->route('resources.dashboard')->with('success', 'Leave request rejected successfully.');
    // }



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
}
