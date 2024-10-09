<?php

use App\Http\Controllers\API\{
    PostController,
    LeaveRequestController, // Use PascalCase for controller names
    CalendarGroupController,
    CalendarWorkDayController,
    AttendanceController,
    NotificationController,
};
use App\Http\Controllers\AuthController;
use App\Models\CalendarGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// =====>Public Routes<======
Route::post('/login', [AuthController::class, 'login']);

// ======>Authenticated Routes<=======
Route::middleware('auth:sanctum')->group(function () {
    // =====>get authenticated specific profile<====
    Route::get('/me', [AuthController::class, 'index']);

    // ======>List positions <=====
    Route::get('/position/list', [PostController::class, 'index']);

    // ======>authenticated user's profile<=====
    Route::get('/employee', function (Request $request) {
        return $request->user(); // Return the authenticated user's details
    });

    // =====>CRUD operations for leave requests<====
    Route::apiResource('leave_requests', LeaveRequestController::class);
    
    // ======>Approve and reject leave requests<=====
    Route::post('/leave_requests/{id}/approve', [LeaveRequestController::class, 'approve']);
    Route::post('/leave_requests/{id}/reject', [LeaveRequestController::class, 'reject']);

    //=======>Calendar_groups<=========
    Route::get('/calendar_groups/{id}', [CalendarGroupController::class, 'index']);
    Route::get('/calendar_work', [CalendarWorkDayController::class, 'index']);
});

//========>Attendance<========

Route::middleware('auth:sanctum')->group(function () {
    Route::post('attendance/clock-in', [AttendanceController::class, 'clockIn']);
    Route::post('attendance/clock-out', [AttendanceController::class, 'clockOut']);
    Route::get('attendance/history', [AttendanceController::class, 'getAttendanceHistory']);
});


//========>Notification<========

Route::middleware('auth:sanctum')->group(function () {
    Route::get('notification', [NotificationController::class, 'index']);
    Route::post('notification/{id}/read', [NotificationController::class, 'read']);
});



Route::middleware('auth:sanctum')->group(function () {
    // Route to trigger Telegram notification after leave request
    Route::post('notification/{id}', [NotificationController::class, 'notifyAfterLeaveRequest']);
    Route::post('leave_requests/{id}/approve', [NotificationController::class, 'approveLeaveRequest']);
    Route::post('leave_requests/{id}/reject', [NotificationController::class, 'rejectLeaveRequest']);
});
