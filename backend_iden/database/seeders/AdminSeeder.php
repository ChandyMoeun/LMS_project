<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);

        $employee = Employee::create([
            'staff_id' => '001', // Assuming you have a staff ID
            'full_name' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('password'),
            'gender' => 'Male', // Or 'Female'
            'dob' => '1990-01-01', // Example date of birth
            'joined_date' => now(),
            'entitled_calendar' => 1, // Assuming the calendar ID is 1
            'reporting_line' => null, // Or specify a reporting line if available
            'profile_image' => null, // If no image is provided
            'position_id' => 1, // Assuming the position ID is 1
            'department_id' => 1, // Assuming the department ID is 1
        ]);

        // Create Roles
        $admin_role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $writer_role = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $employee_role = Role::create(['name' => 'employee', 'guard_name' => 'web']);

        // Create Permissions
        $permissions = [
            //<====>Post access====>
            'Post access',
            'Post edit',
            'Post create',
            'Post delete',
            //<====>Role access====>
            'Role access',
            'Role edit',
            'Role create',
            'Role delete',
            //<====>User access====>
            'User access',
            'User edit',
            'User create',
            'User delete',
            //<====>Permission access====>
            'Permission access',
            'Permission edit',
            'Permission create',
            'Permission delete',
            //<====>Mail access====>
            'Mail access',
            'Mail edit',
            //<====>Employee access====>
            'Employee access',
            'Employee edit',
            'Employee create',
            'Employee delete',
            //<====>Calendar access====>
            'Calendar access',
            'Calendar edit',
            'Calendar create',
            'Calendar delete',
            //<====>Position access====>
            'Position access',
            'Position edit',
            'Position create',
            'Position delete',
            //<====>Attendance access====>
            'Attendance access',
            'Attendance edit',
            'Attendance create',
            'Attendance delete',
            //<====>Leave access====>
            'Leave access',
            'Leave edit',
            'Leave create',
            'Leave delete',
            //<====>Leave Type access====>
            'LeaveType access',
            'LeaveType edit',
            'LeaveType create',
            'LeaveType delete',
            //<====>Department access====>
            'Department access',
            'Department edit',
            'Department create',
            'Department delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign Roles to Users
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $employee->assignRole($employee_role);

        // Give All Permissions to Admin Role
        $admin_role->givePermissionTo(Permission::all());
    }
}
