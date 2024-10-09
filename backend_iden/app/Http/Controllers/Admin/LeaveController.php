<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use Carbon\Carbon;



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
        $leaveRequests = LeaveRequest::with('employee', 'leaveType', 'approver', 'rejector')->paginate(10);
        return view('leave.index', compact('leaveRequests'));
    }

    public function LeaveRequestDashboard()
    {
        // Paginate leave requests and load the associated employee data
        $leaveRequests = LeaveRequest::with('employee', 'leaveType', 'approver', 'rejector')->paginate(10);
        return view('dashboard', compact('leaveRequests'));
    }


    public function show($id)
    {
        // Find the leave request by ID or fail if not found
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Return the view with leave request details
        return view('employee.more.index', compact('leaveRequest'));
    }

    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        // $positions = Position::all(); // Get all available positions
        // $employees = Employee::with('roles', 'position')->get(); // Get all employees with roles and positions
        // $leaveTypes = LeaveType::all(); // Get all leave types (leave employees relationship out since it's not needed for leave types)

        // return view('leave.request', compact('leaveTypes', 'positions', 'employees'));



        // ======>test<======


        // Fetch all available positions
        $positions = Position::all();

        // Get the current date
        $now = Carbon::now();

        // Filter employees and determine if they are eligible for annual leave
        $employees = Employee::with('roles', 'position')
            ->get()
            ->map(function ($employee) use ($now) {
                // Compare `joined_date` with `entitled_date`
                if (!empty($employee->entitled_date) && !empty($employee->joined_date)) {
                    $joinedDate = Carbon::parse($employee->joined_date);
                    $entitledDate = Carbon::parse($employee->entitled_date);

                    // Determine if the employee is eligible for annual leave based on entitled_date
                    $employee->eligible_for_annual_leave = $joinedDate->gte($entitledDate);
                } else {
                    // If either of the dates are null, assume they are not eligible
                    $employee->eligible_for_annual_leave = false;
                }
                return $employee;
            });

        // Get all leave types
        $leaveTypes = LeaveType::all();
        return view('leave.request', compact('leaveTypes', 'positions', 'employees'));
    }

    /**
     * Store a newly created leave request in the database.
     */
    public function store(Request $request)
    {
        // Validate the request (add validation for attachments if needed)
        $request->validate([
            'leave_type_id' => 'required|integer',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
            'attachment.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,doc,docx,xls,xlsx,ppt,pptx,pdf|max:2048', // Max 2MB per file

        ]);

        // Handle file upload if there are any attachments
        if ($request->hasFile('attachment')) {
            $attachmentPaths = []; // Array to hold the paths of multiple attachments
            foreach ($request->file('attachment') as $file) {
                // Store each file in the 'uploads' folder in the 'public' disk
                $path = $file->store('uploads', 'public');
                $attachmentPaths[] = $path; // Add the file path to the array
            }
            // Convert the array of paths into a comma-separated string or store as JSON
            $attachmentPath = json_encode($attachmentPaths); // Or use implode(',', $attachmentPaths) for comma-separated
        } else {
            $attachmentPath = null; // Set to null if no attachments are uploaded
        }

        // Create a new leave request
        $leaveRequest = LeaveRequest::create([
            'employee_id' => Auth::id(), // Assuming the logged-in user is the employee
            'leaveType_id' => $request->leave_type_id,
            'half_day_type' => $request->half_day_type,
            'start_time' => $request->half_day_type == 'time' ? $request->start_time : null,
            'end_time' => $request->half_day_type == 'time' ? $request->end_time : null,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'duration_leave' => $request->duration_leave,
            'requested_at' => $request->requested_at,
            'approved_at' => $request->approved_at ?? null,
            'attachment' => $attachmentPath, // Store the attachment paths (comma-separated or JSON)
            'status' => 'pending',
            'total_requested_days' => $this->calculateLeaveDays($request),
        ]);

        $notificationController = new NotificationController();
        $notificationController->notifyAfterLeaveRequest($leaveRequest->id);

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
        // Mark the leave request as approved
        $leaveRequest->status = 'approved';
        $leaveRequest->approved_by = auth()->user()->id; // Store the ID of the user who approved the request
        
        // Get the associated leave type (assuming there's a relationship between LeaveRequest and LeaveType)
        $leaveType = $leaveRequest->leaveType; // Assuming LeaveRequest has a leaveType relationship

        // Ensure there's an increase_rate to subtract
        if ($leaveType->increase_rate > 0) {
            // Subtract 1 from the increase_rate
            $leaveType->increase_rate -= 1;
            $leaveType->save();
        }
        $leaveRequest->save();
        // Redirect to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Leave request approved successfully and 1 day was subtracted from the increase rate.');
    }

    // =====>reject request<======
    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->status = 'rejected';
        $leaveRequest->rejected_by = auth()->user()->id; // Store the ID of the user who rejected the request
        $leaveRequest->save();

        return redirect()->route('admin.dashboard')->with('success', 'Leave request rejected successfully.');
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
