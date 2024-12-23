<?php

// use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\API\{
    PostController,
    LeaveRequestController, // Use PascalCase for controller names
    CalendarHolidayController,
    CalendarWorkDayController,
    AttendanceController,
    NotificationController,
    LeaveBalanceController,
    DepartmentController,
    PositionController,
    LeaveTypeController,
    EmployeeController,
    MemberController, // Add MemberController to the list

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
    Route::get('/team', [AuthController::class, 'getTeam']);
    Route::get('/team/{id}', [AuthController::class, 'getTeamMemberById']);

    // ======>authenticated user's profile<=====
    Route::get('/employee', function (Request $request) {
        return $request->user()->all(); // Return the authenticated user's details
    });
    // =======>get Team <=======
    // Route::get('/employees/team/{manager_id}', [EmployeeController::class, 'getTeamMembers']);
    Route::get('/member', [MemberController::class, 'getMember']);


    // =====>CRUD operations for leave requests<====
    // Route::apiResource('leave_requests', LeaveRequestController::class);
    Route::get('leave_requests', [LeaveRequestController::class, 'index']);
    Route::post('/leave_requests', [LeaveRequestController::class, 'leaveRequests']);
    Route::get('/leave_requests/team', [LeaveRequestController::class, 'getTeamLeaveRequests']);
    Route::get('/leave_requests/team/{id}', [LeaveRequestController::class, 'getTeamLeaveRequestsById']);
    Route::get('/leave_balances', [LeaveBalanceController::class, 'index']);



    //=======>Leave types<=========
    Route::get('leave_types', [LeaveTypeController::class, 'getLeaveType']);

    // ======>Approve and reject leave requests<=====
    Route::post('/leave_requests/{id}/approve_request', [LeaveRequestController::class, 'approveLeaveRequest']);
    Route::post('/leave_requests/{id}/reject_request', [LeaveRequestController::class, 'reject']);

    //=======>Calendar_groups<=========
    Route::get('/calendar_holiday', [CalendarHolidayController::class, 'calendarHoliday']);
    Route::get('/calendar_work', [CalendarWorkDayController::class, 'CalendarWorkday']);
});

Route::middleware('auth:sanctum')->group(function () {});

//========>Attendance<========

Route::middleware('auth:sanctum')->group(function () {
    Route::post('attendance/clock-in', [AttendanceController::class, 'clockIn']);
    Route::post('attendance/clock-out', [AttendanceController::class, 'clockOut']);
    Route::get('attendance/history', [AttendanceController::class, 'getAttendanceHistory']);
});


// ======>List Department <=====
Route::middleware('auth:sanctum')->group(function () {
    Route::get('departments', [DepartmentController::class, 'index']);
    Route::get('/departments/{departmentId}', [DepartmentController::class, 'show']);
    Route::get('/employees/department/{department_id}', [EmployeeController::class, 'getEmployeesByDepartment']);
});

// ======>List  Position<=====
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/position/list', [PositionController::class, 'index']);
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

// <======leave balanced=====>
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('leave_balances', LeaveBalanceController::class);
});

