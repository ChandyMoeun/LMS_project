<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendWelcomeEmail(){
        $toEmail ="emcha7231@gmail.com";
        $message = "Welcome to Email test";
        $subject = "Welcome to Email test in laravel";
        $response = Mail::to($toEmail)->send(new WelcomeEmail($message,$subject));
        dd($response);
    }
}
