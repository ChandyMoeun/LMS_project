<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Mailsetting;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mail settings configuration
        if (\Schema::hasTable('mailsettings')) {
            $mailsetting = Mailsetting::first();
            if ($mailsetting) {
                $data = [
                    'driver' => $mailsetting->mail_transport,
                    'host' => $mailsetting->mail_host,
                    'port' => $mailsetting->mail_port,
                    'encryption' => $mailsetting->mail_encryption,
                    'username' => $mailsetting->mail_username,
                    'password' => $mailsetting->mail_password,
                    'from' => [
                        'address' => $mailsetting->mail_from,
                        'name' => 'LaravelStarter',
                    ],
                ];
                Config::set('mail', $data);
            }
        }

        // View composer for notifications
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $employeeId = Auth::id();

                // =====>Check if the logged-in employee is roles an admin<=======
                $isAdmin = Auth::user()->hasRole('admin'); 

                if ($isAdmin) {
                    // ======>Count all leave requests for all employees<=======
                    $totalLeaveCount = LeaveRequest::count();
                    // ======>Count all pending leave requests<========
                    $pendingLeaveCount = LeaveRequest::where('status', 'pending')->count();
                    // ======>Count all approved leave requests<========
                    $approvedLeaveCount = LeaveRequest::where('status', 'approved')->count();
                } else {
                    // =====>For regular employees, count their own leave requests<======
                    $totalLeaveCount = LeaveRequest::where('employee_id', $employeeId)->count();
                    // ======>Count pending leave requests<========
                    $pendingLeaveCount = LeaveRequest::where('employee_id', $employeeId)
                        ->where('status', 'pending')
                        ->count();
                    // ====>Count approved leave requests<======
                    $approvedLeaveCount = LeaveRequest::where('employee_id', $employeeId)
                        ->where('status', 'approved')
                        ->count();
                }
                // =====>Pass all counts to the view<========
                $view->with(compact('totalLeaveCount', 'pendingLeaveCount', 'approvedLeaveCount'));
            }
        });
    }
}
