<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
    /**
     * LeaveController constructor with role-based permissions.
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:Leave access|Leave create|Leave edit|Leave delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Leave create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Leave edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Leave delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of leave requests.
     */
    public function index()
    {
        // Paginate leave requests and load the associated employee data
        $leaveRequests = LeaveRequest::with('employee', 'leaveType')->paginate(10);
        return view('leave.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        $positions = Position::all(); // Get all available positions
        $employees = Employee::with('roles', 'position')->get(); // Get all employees with roles and positions
        $leaveTypes = LeaveType::all(); // Get all leave types (leave employees relationship out since it's not needed for leave types)

        return view('leave.request', compact('leaveTypes', 'positions', 'employees'));
    }

    /**
     * Store a newly created leave request in the database.
     */
    public function store(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'leave_type_id' => 'required|exists:leave_types,id',
        //     'from_date' => 'required|date',
        //     'to_date' => 'nullable|date|after_or_equal:from_date',
        //     'half_day_type' => 'required|in:full_day,morning,afternoon,time',
        //     'start_time' => 'nullable|date_format:H:i|required_if:half_day_type,time',
        //     'end_time' => 'nullable|date_format:H:i|required_if:half_day_type,time',
        //     'reason' => 'nullable|string|max:255',
        //     'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Accepts image/pdf attachments
        // ]);

        // Handle file upload if there is any
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }


        // Create a new leave request

        LeaveRequest::create([
            'employee_id' => Auth::id(), // Assuming you are using Auth to get the current user ID
            'leaveType_id' => $request->leave_type_id, // Ensure this is being passed
            'half_day_type' => $request->half_day_type,
            'start_time' => $request->start_time, // Only required if half_day_type is 'time'
            'end_time' => $request->end_time, // Only required if half_day_type is 'time'
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'duration_leave' => $request->duration_leave,
            'requested_at' => $request->quested_at,
            'approved_at' => $request->approved_at,
            'attachment' => $attachmentPath, // Path to the uploaded file
            'status' => 'pending', // Default status
            'total_requested_days' => $this->calculateLeaveDays($request),
        ]);


        return redirect()->route('admin.leave.index')->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Show the form for editing a leave request.
     */
    public function edit($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveTypes = LeaveType::all();
        return view('leave.edit', compact('leaveRequest', 'leaveTypes'));
    }

    /**
     * Update the specified leave request.
     */
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Validate the request
        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'half_day_type' => 'required|in:full_day,morning,afternoon,time',
            'start_time' => 'nullable|date_format:H:i|required_if:half_day_type,time',
            'end_time' => 'nullable|date_format:H:i|required_if:half_day_type,time',
            'reason' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Handle file upload if there is any
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Update leave request details
        $leaveRequest->update([
            'leave_type_id' => $request->leave_type_id,
            'half_day_type' => $request->half_day_type,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'attachment' => $attachmentPath ?? $leaveRequest->attachment,
            'total_requested_days' => $this->calculateLeaveDays($request),
        ]);

        return redirect()->route('leave.index')->with('success', 'Leave request updated successfully.');
    }

    // =====>approve request<======
    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->status = 'approved'; // Update the status or any other logic
        $leaveRequest->save();

        return redirect()->route('admin.leave.index')->with('success', 'Leave request approved successfully.');
    }

    // =====>reject request<======

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->status = 'rejected'; // Update the status or any other logic
        $leaveRequest->save();

        return redirect()->route('admin.leave.index')->with('success', 'Leave request rejected successfully.');
    }

    /**
     * Remove the specified leave request.
     */
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->delete();

        return redirect()->route('admin.leave.index')->with('success', 'Leave request deleted successfully.');
    }

    /**
     * Helper method to calculate total leave days.
     */
    private function calculateLeaveDays($request)
    {
        $fromDate = \Carbon\Carbon::parse($request->from_date);
        $toDate = $request->to_date ? \Carbon\Carbon::parse($request->to_date) : $fromDate;

        // Handle half-day types
        if ($request->half_day_type == 'time' || $request->half_day_type == 'morning' || $request->half_day_type == 'afternoon') {
            return 0.5; // Half-day leave counts as 0.5 day
        }

        return $fromDate->diffInDays($toDate) + 1; // Full-day leave
    }
}
