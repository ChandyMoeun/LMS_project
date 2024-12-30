<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee; // Use the Employee model instead of User
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Traits\UploadImage;

class ProfileController extends Controller
{
    use UploadImage;

    function __construct() {}

    public function index()
    {
        $employee = auth()->user();  // Assuming authentication is working with Employee
        return view('setting.profile', ['employee' => $employee]);
    }

    public function update(Request $request)
    {
        $employee = auth()->user();  // Assuming authentication is working with Employee

        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id . ',id',  // Adjust the validation to employees
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile')) {
            if ($name = $this->saveImage($request->profile)) {
                $validated['profile'] = $name;
            }
        }

        $employee->update($validated);

        return redirect()->back()->withSuccess('Profile updated successfully!');
    }
}
