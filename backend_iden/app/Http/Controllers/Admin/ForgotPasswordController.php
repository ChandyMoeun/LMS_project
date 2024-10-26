<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Display the password reset request form.
     */
    public function index()
    {
        return view('auth.forgot-password'); // Ensure you have a view at this path
    }

    /**
     * Handle the incoming request to send a reset link.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:employees,email', // Assuming you have an 'employees' table
        ]);

        // Send the reset link
        $status = Password::broker('employees')->sendResetLink(
            $request->only('email')
        );

        // Check if link was sent successfully
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        }

        throw ValidationException::withMessages([
            'email' => __($status),
        ]);
    }
}
