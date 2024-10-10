<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRequest; // Assuming you have a LeaveRequest model
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::where('employee_id', auth()->id())->get();

        return view('notifications.index', compact('notifications'));
    }

    // Create a new notification
    public function createNotification($employeeId, $message, $notificationType, $leaveRequestId = null)
    {
        Notification::create([
            'employee_id' => Auth::id(), // This gets the currently authenticated user's ID
            'message' => $message,
            'notification_type' => $notificationType,
            'leave_request_id' => $leaveRequestId,
            'sent_at' => now(),
        ]);
    }

    // Example usage: Trigger notification after a leave request
    public function notifyAfterLeaveRequest($leaveRequestId)
    {
        $leaveRequest = LeaveRequest::find($leaveRequestId);
        $employeeId = $leaveRequest->employee_id;
        $approverId = $this->getApproverId($leaveRequest);  // Custom logic to get approver ID

        // Create notification for the approver
        $this->createNotification(
            $approverId,
            'An employee has submitted a leave request.',
            'telegram', // or 'email'
            $leaveRequestId
        );
    }

    // Helper function to find the approver ID
    private function getApproverId(LeaveRequest $leaveRequest)
    {
        // Assuming you have logic for fetching the approver based on department/HR hierarchy
        return $leaveRequest->approver_id;
    }

}
