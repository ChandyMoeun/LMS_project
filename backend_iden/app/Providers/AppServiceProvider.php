<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Mailsetting;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

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

        View::composer('layouts.app', function ($view) {
            if (auth()->check()) {
                // Count all notifications in the database
                $notificationsCount = Notification::count();
                // Pass the notification count to the view (layouts.app)
                $view->with('notificationsCount', $notificationsCount);
            }
        });
    }
}
