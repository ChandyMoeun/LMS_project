<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate the email field
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:employees,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve the employee using the validated email
        $employee = Employee::where('email', $request->input('email'))->first();

        // Check if the employee exists
        if (!$employee) {
            return back()->withErrors(['email' => 'Employee not found.'])->withInput();
        }

        // Generate a password reset token
        $employee->remember_token = Str::random(60);
        $employee->save();

        // Prepare the verification URL
        $verificationUrl = url('/verify/' . $employee->remember_token);

        // Send a plain text email
        try {
            Mail::raw("To reset your password, click the following link: $verificationUrl", function ($message) use ($employee) {
                // Ensure $employee is not null
                if ($employee) {
                    $message->to($employee->email)
                        ->subject('Password Reset Request');
                } else {
                    // Log or handle the error if employee is null
                    throw new \Exception('Employee object is null');
                }
            });

            // Redirect back with a success message
            return back()->with('status', 'Password reset email sent successfully.');
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error)
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.'])->withInput();
        }
    }
}
