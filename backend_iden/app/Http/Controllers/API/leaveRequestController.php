<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class leaveRequestController extends Controller
{
    /**
     * Display a listing of leave requests.
     */
    public function index()
    {
        // Paginate leave requests and load the associated employee data
        // $leaveRequests = LeaveRequest::with('employee', 'leaveType')->paginate(10);
        // return response()->json([
        //     'message' => 'Leave requests retrieved successfully',
        //     'data' => $leaveRequests
        // ]);

        // Paginate leave requests and load associated employee, leaveType, approver, and rejector data
        $leaveRequests = LeaveRequest::with('employee', 'leaveType', 'approver', 'rejector')->paginate(10);

        return response()->json([
            'message' => 'Leave requests retrieved successfully',
            'data' => $leaveRequests
        ]);
    }

    /**
     * Store a newly created leave request in the database.
     */
    public function store(Request $request)
    {
        // Handle file upload if there is any
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Create a new leave request
        $leaveRequest = LeaveRequest::create([
            'employee_id' => Auth::id(), // Assuming you are using Auth to get the current user ID
            'leaveType_id' => $request->leaveType_id,
            'half_day_type' => $request->half_day_type,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
            'status' => 'pending', // Default status
            'total_requested_days' => $this->calculateLeaveDays($request),
        ]);

        return response()->json([
            'message' => 'Leave request submitted successfully.',
            'data' => $leaveRequest
        ], 201);
    }


    /**
     * Show the specified leave request.
     */
    public function show($id)
    {
        // $leaveRequest = LeaveRequest::with('employee', 'leaveType')->findOrFail($id);
        // return response()->json([
        //     'message' => 'Leave request retrieved successfully.',
        //     'data' => $leaveRequest
        // ]);

        // Find leave request by ID and load associated employee, leaveType, approver, and rejector data
        $leaveRequest = LeaveRequest::with('employee', 'leaveType', 'approver', 'rejector')->findOrFail($id);

        return response()->json([
            'message' => 'Leave request retrieved successfully.',
            'data' => $leaveRequest
        ]);
    }

    /**
     * Update the specified leave request.
     */
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
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
            'leave_type_id' => $validated['leave_type_id'],
            'half_day_type' => $validated['half_day_type'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'from_date' => $validated['from_date'],
            'to_date' => $validated['to_date'],
            'reason' => $validated['reason'],
            'attachment' => $attachmentPath ?? $leaveRequest->attachment,
            'total_requested_days' => $this->calculateLeaveDays($validated),
        ]);

        return response()->json([
            'message' => 'Leave request updated successfully.',
            'data' => $leaveRequest
        ]);
    }


    // Approve the specified leave request
    public function approve($id)
    {
        $leaveRequest = LeaveRequest::find($id);

        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found.'], 404);
        }

        // Ensure the leave request hasn't already been approved
        if ($leaveRequest->status === 'approved') {
            return response()->json(['message' => 'Leave request is already approved.'], 400);
        }

        // Subtract leave days from the employee's balance
        $employee = Employee::find($leaveRequest->employee_id);
        // $totalRequestedDays = $this->calculateLeaveDays($leaveRequest);

        // if ($employee->leave_balance < $totalRequestedDays) {
        //     return response()->json(['message' => 'Insufficient leave balance.'], 400);
        // }

        // $employee->leave_balance -= $totalRequestedDays;
        $employee->save();

        // Update leave request status and approver
        $leaveRequest->status = 'approved';
        $leaveRequest->approved_by = Auth::id(); // Set the ID of the user who approved
        $leaveRequest->rejected_by = null; // Clear rejected_by if previously set
        $leaveRequest->save();

        return response()->json([
            'message' => 'Leave request approved successfully.',
            'data' => [
                'leave_request' => $leaveRequest,
                'approved_by' => $leaveRequest->approver->full_name, // Return the approver's name
                
            ]
        ], 200);
    }

    // Reject the specified leave request
    public function reject($id)
    {
        $leaveRequest = LeaveRequest::find($id);

        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found.'], 404);
        }

        // Ensure the leave request hasn't already been rejected
        if ($leaveRequest->status === 'rejected') {
            return response()->json(['message' => 'Leave request is already rejected.'], 400);
        }

        // Update leave request status and rejector
        $leaveRequest->status = 'rejected';
        $leaveRequest->rejected_by = Auth::id(); // Set the ID of the user who rejected
        $leaveRequest->approved_by = null; // Clear approved_by if previously set
        $leaveRequest->save();

        return response()->json([
            'message' => 'Leave request rejected successfully.',
            'data' => [
                'leave_request' => $leaveRequest,
                'rejected_by' => $leaveRequest->rejector->full_name // Return the rejector's name
            ]
        ], 200);
    }

    /**
     * Helper method to calculate total leave days.
     */
    private function calculateLeaveDays($request)
    {
        $fromDate = \Carbon\Carbon::parse($request['from_date']);
        $toDate = $request['to_date'] ? \Carbon\Carbon::parse($request['to_date']) : $fromDate;

        // Handle half-day types
        if ($request['half_day_type'] == 'time' || $request['half_day_type'] == 'morning' || $request['half_day_type'] == 'afternoon') {
            return 0.5; // Half-day leave counts as 0.5 day
        }

        return $fromDate->diffInDays($toDate) + 1; // Full-day leave
    }
}
