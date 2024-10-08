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
    LeavePfDetailController
};

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

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';





Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
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
        Route::resource('leavetype', 'LeaveTypeController');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');

        // Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
        // Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');


        //=====>Calendar workday/time<=====
        // Route::get('/calendar', [CalendarWorkDayController::class, 'index'])->name('admin.calendar_workday.index');

        Route::get('/position', [PositionController::class, 'index'])->name('position.index');
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
        Route::get('/leavetype', [LeaveTypeController::class, 'index'])->name('leavetype.index');

        //more//
        Route::get('/more', [LeavePfDetailController::class, 'index'])->name('more.index');
        Route::get('/employee/profile/{id}', [LeavePfDetailController::class, 'employeeProfile']);
      
    });
    