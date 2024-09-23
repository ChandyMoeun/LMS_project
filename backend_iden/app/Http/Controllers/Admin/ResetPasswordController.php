<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller

{

    public function index()
    {
        // Fetch all employees
        $employees = Employee::all();

        // Pass the employee data to the view
        return view('employee.resetpassword.index', compact('employees'));
    }
    /**
     * Show the form to reset an employee's password.
     */
    // Display form for resetting the password
    public function resetForm($id)
    {
        $employee = Employee::findOrFail($id); // Find the employee by ID
        return view('employee.resetpassword.form', compact('employee'));
    }

    // Handle password reset request
    public function reset(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->password = Hash::make($request->input('password')); // Hash and save the new password
        $employee->save();

        return redirect()->route('admin.employee.resetpassword.form', ['id' => $employee->id])
            ->with('success', 'Password reset successfully!');
    }
}
