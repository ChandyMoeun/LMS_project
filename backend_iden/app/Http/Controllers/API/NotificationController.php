<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import for Telegram API requests

class NotificationController extends Controller
{
    // Get notifications and leave request counts for the authenticated user
    public function index(): JsonResponse
    {
        $employeeId = auth()->id(); // Get the authenticated employee ID

        // Fetch notifications
        $notifications = Notification::where('employee_id', $employeeId)->get();

        // Count leave requests
        $pendingLeaveCount = LeaveRequest::where('employee_id', $employeeId)
            ->where('status', 'pending')
            ->count();
        $approvedLeaveCount = LeaveRequest::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->count();

        // Prepare response data
        $response = [
            'notifications' => $notifications,
            'pendingLeaveCount' => $pendingLeaveCount,
            'approvedLeaveCount' => $approvedLeaveCount,
        ];

        return response()->json($response);
    }

    // Send Telegram notification with employee name and leave request details
    private function sendTelegramNotification($message, $employeeName)
    {
        // Your Telegram Bot Token
        $telegramBotToken = env('TELEGRAM_BOT_TOKEN'); // Store in .env
        // Your Telegram Chat ID (group or individual)
        $chatId = env('TELEGRAM_CHAT_ID'); // Store in .env

        // Format message to include employee name
        $formattedMessage = "{$employeeName}: {$message}";

        // Send message to Telegram API
        $response = Http::post("https://api.telegram.org/bot{$telegramBotToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $formattedMessage,
        ]);

        return $response->successful();
    }

    // Create a new notification
    private function createNotification($message, $notificationType, $leaveRequestId = null)
    {
        // Save the notification to the database
        Notification::create([
            'employee_id' => Auth::id(), // Authenticated employee ID
            'message' => $message,
            'notification_type' => $notificationType,
            'leave_request_id' => $leaveRequestId,
            'sent_at' => now(),
        ]);
    }

    // Trigger notification after a leave request
    public function notifyAfterLeaveRequest($leaveRequestId): JsonResponse
    {
        $leaveRequest = LeaveRequest::find($leaveRequestId);

        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found'], 404);
        }

        $approverId = $this->getApproverId($leaveRequest);
        $employeeName = Auth::id(); // Get the authenticated employee's name

        // Prepare the message with all leave request details
        $message = "Leave Request Details:\n" .
            "Employee Name: {$leaveRequest->employee->full_name}\n" .  // Assuming 'employee' is the relationship
            "Leave Type: {$leaveRequest->leaveType->leave_name}\n" . // Assuming 'leaveType' is the relationship and it has a 'name' attribute
            "Start Date: {$leaveRequest->from_date}\n" .
            "End Date: {$leaveRequest->to_date}\n" .
            "Start Time: {$leaveRequest->start_time}\n" .
            "End Time: {$leaveRequest->end_time}\n" .
            "Status: {$leaveRequest->status}\n" .
            "Total Days: {$leaveRequest->total_requested_days}\n" .
            "Half Day: {$leaveRequest->half_day_type}\n" .
            "Reason: {$leaveRequest->reason}\n";

        // Create notification for the approver
        $this->createNotification($message, 'telegram', $leaveRequestId);

        // Send the notification to Telegram with employee name
        $this->sendTelegramNotification($message, $employeeName);

        return response()->json(['message' => 'Notification sent successfully'], 201);
    }

    // Helper function to find the approver ID
    private function getApproverId(LeaveRequest $leaveRequest): ?int
    {
        // Assuming you have logic for fetching the approver based on department/HR hierarchy
        return $leaveRequest->approver_id;
    }

    // Approve or reject leave request alert to telegram
    public function approveLeaveRequest($leaveRequestId): JsonResponse
    {
        $leaveRequest = LeaveRequest::find($leaveRequestId);

        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found'], 404);
        }

        // Update leave request status
        $leaveRequest->status = 'approved';
        $leaveRequest->save();

        // Prepare the message for Telegram
        $message = "Leave Request Approved:\n" .
            "Employee Name: {$leaveRequest->employee->full_name}\n" .
            "Leave Type: {$leaveRequest->leaveType->leave_name}\n" .
            "Start Date: {$leaveRequest->from_date}\n" .
            "End Date: {$leaveRequest->to_date}\n" .
            "Total Days: {$leaveRequest->total_requested_days}\n" .
            "Reason: {$leaveRequest->reason}\n";

        // Create notification for the approver
        $this->createNotification($message, 'telegram', $leaveRequestId);

        // Send the approval notification to Telegram
        $this->sendTelegramNotification($message, Auth::user()->full_name); // Send the name of the approver or any relevant name

        return response()->json(['message' => 'Leave request approved successfully'], 200);
    }

    // Reject a leave request
    public function rejectLeaveRequest($leaveRequestId): JsonResponse
    {
        $leaveRequest = LeaveRequest::find($leaveRequestId);

        if (!$leaveRequest) {
            return response()->json(['message' => 'Leave request not found'], 404);
        }

        // Update leave request status
        $leaveRequest->status = 'rejected';
        $leaveRequest->save();

        // Prepare the message for Telegram
        $message = "Leave Request Rejected:\n" .
            "Employee Name: {$leaveRequest->employee->full_name}\n" .
            "Leave Type: {$leaveRequest->leaveType->leave_name}\n" .
            "Start Date: {$leaveRequest->from_date}\n" .
            "End Date: {$leaveRequest->to_date}\n" .
            "Total Days: {$leaveRequest->total_requested_days}\n" .
            "Reason: {$leaveRequest->reason}\n";

        // Create notification for the approver
        $this->createNotification($message, 'telegram', $leaveRequestId);

        // Send the rejection notification to Telegram
        $this->sendTelegramNotification($message, Auth::user()->full_name); // Send the name of the approver or any relevant name

        return response()->json(['message' => 'Leave request rejected successfully'], 200);
    }
}
