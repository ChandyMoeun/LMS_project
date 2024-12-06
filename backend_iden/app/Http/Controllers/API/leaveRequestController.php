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
use App\Models\Notifications;
use Illuminate\Support\Facades\Log; // Make sure to import the Log facade

class leaveRequestController extends Controller
{
    /**
     * Display a listing of leave requests.
     */
    public function index()
    {
        $leaveRequests = LeaveRequest::with(['employee', 'LeaveType'])->get(); // Eager load both relationships
        return response()->json($leaveRequests);

        // Paginate leave requests and load associated employee, leaveType, approver, and rejector data
        // $leaveRequests = LeaveRequest::with('employee', 'leaveType', 'approver', 'rejector')->paginate(10);

        // return response()->json([
        //     'message' => 'Leave requests retrieved successfully',
        //     'data' => $leaveRequests
        // ]);
    }

    public function getTeamLeaveRequests()
    {
        // Get the currently authenticated manager's ID
        $managerId = Auth::id();

        // Get the department ID of the authenticated manager
        $manager = Employee::where('id', $managerId)->first();

        if (!$manager || !$manager->department_id) {
            return response()->json([
                'message' => 'Manager or department not found.',
                'data' => [],
            ], 404);
        }

        $departmentId = $manager->department_id;

        // Get the current week range
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek(); // Start of the current week
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek(); // End of the current week

        // Fetch leave requests for employees in the manager's department
        $leaveRequests = LeaveRequest::whereHas('employee', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId); // Filter by department ID
        })
            ->with(['employee', 'leaveType'])
            ->latest() // Sort by 'created_at' descending
            ->get();

        // Count leave requests for the current week
        $leaveRequestCountThisWeek = LeaveRequest::whereHas('employee', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId); // Filter by department ID
        })
            ->whereBetween('from_date', [$startOfWeek, $endOfWeek]) // Filter by current week
            ->count();

        // Format the leave requests for a cleaner response
        $formattedLeaveRequests = $leaveRequests->map(function ($leaveRequest) {
            return [
                'id' => $leaveRequest->id,
                'employee_name' => $leaveRequest->employee->full_name,
                'employee_id' => $leaveRequest->employee->id,
                'profile' => $leaveRequest->employee->profile,
                'staff_id' => $leaveRequest->employee->staff_id,
                'leave_type' => $leaveRequest->leaveType ? $leaveRequest->leaveType->leave_name : 'N/A', // Handle null leaveType
                'from_date' => \Carbon\Carbon::parse($leaveRequest->from_date)->format('Y-m-d'),
                'to_date' => \Carbon\Carbon::parse($leaveRequest->to_date)->format('Y-m-d'),
                'start_time' => $leaveRequest->start_time,
                'end_time' => $leaveRequest->end_time,
                'status' => $leaveRequest->status,
                'total_requested_days' => $leaveRequest->total_requested_days,
                'half_day_type' => $leaveRequest->half_day_type,
                'attachment' => $leaveRequest->attachment,
                'position' => $leaveRequest->employee->position->name ?? 'No Position', // Fallback if no position exists
                'department' => $leaveRequest->employee->department->name ?? 'No Department', // Fallback if
                'reason' => $leaveRequest->reason,
                'created_at' => \Carbon\Carbon::parse($leaveRequest->created_at)->format('Y-m-d | H:i:s'),
                'updated_at' => \Carbon\Carbon::parse($leaveRequest->updated_at)->format('Y-m-d | H:i:s'),
                'approved_by' => $leaveRequest->approver ? $leaveRequest->approver->full_name : null, // Get the approver's name
                'rejected_by' => $leaveRequest->rejector ? $leaveRequest->rejector->full_name : null, // Get rejector's name
            ];
        });

        return response()->json([
            'message' => 'Leave requests for manager\'s department retrieved successfully.',
            'data' => $formattedLeaveRequests,
            'leave_request_count_this_week' => $leaveRequestCountThisWeek, // Add count of leave requests for the current week
        ]);
    }

    // Get by id
    public function getTeamLeaveRequestsById($id)
    {
        $managerId = Auth::id(); // Get the currently authenticated manager's ID

        // Retrieve the leave request by ID for either the manager or their team members
        $leaveRequest = LeaveRequest::where(function ($query) use ($managerId) {
            $query->where('employee_id', $managerId) // Manager's own leave requests
                ->orWhereHas('employee', function ($subQuery) use ($managerId) {
                    $subQuery->where('manager_id', $managerId); // Team members' leave requests
                });
        })->with(['employee', 'leaveType'])->find($id); // Find the leave request by the provided ID

        if (!$leaveRequest) {
            return response()->json([
                'message' => 'Leave request not found',
            ], 404);
        }

        // Format the leave request to include only specific fields
        $formattedLeaveRequest = [
            'id' => $leaveRequest->id,
            'employee_name' => $leaveRequest->employee->full_name,
            'employee_id' => $leaveRequest->employee->id,
            'staff_id' => $leaveRequest->employee->staff_id,
            'leave_type' => $leaveRequest->leaveType->leave_name,
            'from_date' => \Carbon\Carbon::parse($leaveRequest->from_date)->format('Y-m-d'),
            'to_date' => \Carbon\Carbon::parse($leaveRequest->to_date)->format('Y-m-d'),
            'status' => $leaveRequest->status,
            'total_requested_days' => $leaveRequest->total_requested_days,
            'half_day_type' => $leaveRequest->half_day_type,
            'attachment' => $leaveRequest->attachment,
            'reason' => $leaveRequest->reason,
            'approved_by' => $leaveRequest->approver ? $leaveRequest->approver->full_name : null, // Get the approver's name
            'rejected_by' => $leaveRequest->rejector ? $leaveRequest->rejector->full_name : null, // Get rejector's name
            'profile' => $leaveRequest->employee->profile ? $leaveRequest->employee->profile : null, // Get profile ID by employee_id
            'created_at' => \Carbon\Carbon::parse($leaveRequest->created_at)->format('Y-m-d | H:i:s'),
            'updated_at' => \Carbon\Carbon::parse($leaveRequest->updated_at)->format('Y-m-d | H:i:s'),

        ];

        return response()->json([
            'message' => 'Leave request retrieved successfully.',
            'data' => $formattedLeaveRequest,
        ]);
    }






    /**
     * Store a newly created leave request in the database.
     */
    public function store(Request $request)
    {
        Log::info('Request Data:', ['request' => $request->all()]);

        // Handle file upload if there are any
        $attachmentPaths = [];
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                if ($file->isValid()) {
                    // Store each file and add the path to the array
                    $attachmentPaths[] = $file->store('attachment', 'public');
                } else {
                    Log::warning('Invalid file uploaded', ['file' => $file]);
                }
            }
        }

        // Log the file paths
        Log::info('File Attachments:', ['attachment' => $attachmentPaths]);

        // Convert attachment paths to JSON
        $attachmentsJson = !empty($attachmentPaths) ? json_encode($attachmentPaths) : null;

        // Create a new leave request without validation
        $leaveRequest = LeaveRequest::create([

            'employee_id' => Auth::id(), // Assuming the employee ID is always required (we assume logged-in user)
            'leaveType_id' => $request->leaveType_id ?? null, // Set to null if not provided
            'half_day_type' => $request->half_day_type ?? null, // Set to null if not provided
            'start_time' => $request->start_time ?? null, // Set to null if not provided
            'end_time' => $request->end_time ?? null, // Set to null if not provided
            'from_date' => $request->from_date ?? null, // Set to null if not provided
            'to_date' => $request->to_date ?? null, // Set to null if not provided
            'reason' => $request->reason ?? null, // Set to null if not provided
            'attachment' => $attachmentsJson ?? null, // Use the attachment JSON if available, otherwise null
            'status' => 'pending', // Default to 'pending'
            'total_requested_days' => $request->from_date && $request->to_date
                ? $this->calculateLeaveDays($request)
                : null, // Calculate leave days only if both dates are provided
        ]);


        // Send notification
        $notificationController = new NotificationController();
        $notificationController->notifyAfterLeaveRequest($leaveRequest->id);

        return response()->json([
            'message' => 'Leave request submitted successfully.',
            'data' => $leaveRequest
        ], 201);
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
            'half_day_type' => 'required|in:AM,PM',  // Only allow "AM" or "PM" if these are valid options
            'start_time' => 'required|date_format:H:i:s',  // Enforce format
            'end_time' => 'required|date_format:H:i:s',  // Enforce format
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',  // Enforce `to_date` after or equal to `from_date`
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


    // ===>get My leave<===



    // ======>Approve the specified leave request<========
    public function approveLeaveRequest($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        $approver = Auth::user()->id;
        $leaveRequest->status = 'approved';
        $leaveRequest->approved_by = $approver;
        $leaveRequest->save();

        return response()->json([
            'message' => 'Leave request approved successfully',
            'approver' => Auth::user()->full_name,  // Return the approver's name in the response
        ]);
    }


    // ========>Reject the specified leave request<========
    public function reject($id, Request $request)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $rejector = Auth::user()->id;
        $leaveRequest->status = 'rejected';
        // $leaveRequest->rejection_reason = $request->input('reason');
        $leaveRequest->rejected_by = $rejector;
        $leaveRequest->save();

        return response()->json([
            'message' => 'Leave request rejected successfully',
            'rejector' => Auth::user()->full_name,
        ]);
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

        return $fromDate->diffInDays($toDate); // Full-day leave
    }

    /**
     * Delete the specified leave request.
     */
    public function destroy($id)
    {
        // Find the leave request by ID
        $leaveRequest = LeaveRequest::find($id);

        // Check if the leave request exists
        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found.'], 404);
        }

        // Delete the leave request
        $leaveRequest->delete();

        return response()->json([
            'message' => 'Leave request deleted successfully.',
        ], 200);
    }
}
