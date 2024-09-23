<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
    EmployeeController,
    CalendarController,
    CalendarWorkDayController,
    CalendarHolidayController,
    CalendarGroupController,
    PositionController,
    DepartmentController,
    AttendanceController,
    LeaveController,
    LeaveTypeController,
    LeavePfDetailController,
    DashboardController,
    ResetPasswordController,
};
use App\Http\Controllers\LeaveRequestController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test-mail', function () {

    $message = "Testing mail";

    \Mail::raw('Hi, welcome!', function ($message) {
        $message->to('ajayydavex@gmail.com')
            ->subject('Testing mail');
    });

    dd('sent');
});


Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');


require __DIR__ . '/front_auth.php';

//Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');
require __DIR__ . '/auth.php';





Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('employee', 'EmployeeController');


        //=====>Calendar Group<=====
        Route::resource('calendar_group', 'CalendarGroupController');
        //=====>Calendar workday/time<=====
        // Route::resource('calendar', 'CalendarController');
        Route::resource('calendar_workday', 'CalendarWorkDayController');
        //=====>Calendar Holiday<=====
        Route::resource('calendar_holiday', 'CalendarHolidayController');

        //=====>Employee workday/time<=====
        Route::resource('position', 'PositionController');
        Route::resource('department', 'DepartmentController');
        Route::resource('attendance', 'AttendanceController');
        Route::resource('leave', 'LeaveController');
        //=====>LeaveType<=====
        Route::resource('leavetype', 'LeaveTypeController');


        //=====>Reset password Employee<======
        // Fetch all employees to display in the dropdown
        Route::get('employee/resetpassword/index', [ResetPasswordController::class, 'index'])->name('employee.resetpassword.index');
        // Show reset form for a specific employee
        Route::get('employee/resetpassword/{id}', [ResetPasswordController::class, 'resetForm'])->name('employee.resetpassword.form');
        // Handle password reset form submission
        Route::post('employee/resetpassword/{id}', [ResetPasswordController::class, 'reset'])->name('employee.resetpassword.update');



        //=====>approver or reject route<====
        Route::post('admin/leave/{leaveRequest}/approve', [LeaveController::class, 'approve'])->name('leave.approve');
        Route::post('admin/leave/{leaveRequest}/reject', [LeaveController::class, 'reject'])->name('leave.reject');

        // ======dashboard<=====
        Route::post('dashboard/{leaveRequest}/approve', [DashboardController::class, 'approve'])->name('dashboard.approve');
        Route::post('dashboard/{leaveRequest}/reject', [DashboardController::class, 'reject'])->name('dashboard.reject');




        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');



        Route::get('/admin/leave/{id}', [LeaveController::class, 'show'])->name('admin.leave.show');

        //more//
        Route::get('/more', [LeavePfDetailController::class, 'index'])->name('more.index');
        // Route::get('/more', [LeavePfDetailController::class, 'index'])->name('more.index');
        Route::get('/admin/leave/{id}', [LeaveController::class, 'show'])->name('admin.leave.show');

        //====>details department<=======
        Route::get('admin/department/more/{id}', [DepartmentController::class, 'detail'])->name('department.more.index');
        
        
    });
