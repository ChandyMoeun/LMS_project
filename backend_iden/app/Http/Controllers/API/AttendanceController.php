<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Auth;


class AttendanceController extends Controller
{
    
    // Clock-in functionality
    public function clockIn(Request $request)
    {
        $employee = Auth::user();
        $date = Carbon::now('Asia/Phnom_Penh')->toDateString(); // Use Cambodia time zone for the current date

        // Define the standard working hours in Cambodia time
        $standardClockInTime = Carbon::createFromTime(8, 0, 0, 'Asia/Phnom_Penh'); // 8:00 AM in Cambodia time
        $gracePeriod = 10; // Grace period of 10 minutes

        // Check if the employee has already clocked in
        $attendance = Attendance::firstOrCreate(
            ['employee_id' => $employee->id, 'date' => $date],
            ['status' => 'Present']
        );

        if ($attendance->clock_in) {
            return response()->json(['message' => 'You have already clocked in today.'], 400);
        }

        // Record the clock-in time in Cambodia time
        $clockInTime = Carbon::now('Asia/Phnom_Penh');
        $isLate = $clockInTime->gt($standardClockInTime->addMinutes($gracePeriod));

        $attendance->update([
            'clock_in' => $clockInTime,
            'status' => $isLate ? 'Late' : 'Present'
        ]);

        return response()->json(['message' => 'Clock-in successful.', 'is_late' => $isLate], 200);
    }

    // Clock-out functionality
    public function clockOut(Request $request)
    {
        $employee = Auth::user();
        $date = Carbon::now('Asia/Phnom_Penh')->toDateString(); // Use Cambodia time zone for the current date

        // Define the standard work end time in Cambodia time
        $standardClockOutTime = Carbon::createFromTime(17, 0, 0, 'Asia/Phnom_Penh'); // 5:00 PM in Cambodia time

        // Get the employee's attendance record
        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $date)
            ->first();

        if (!$attendance || !$attendance->clock_in) {
            return response()->json(['message' => 'You have not clocked in today.'], 400);
        }

        if ($attendance->clock_out) {
            return response()->json(['message' => 'You have already clocked out today.'], 400);
        }

        // Record the clock-out time in Cambodia time
        $clockOutTime = Carbon::now('Asia/Phnom_Penh');
        $hoursWorked = Carbon::parse($attendance->clock_in)->diffInMinutes($clockOutTime) / 60;

        $leftEarly = $clockOutTime->lt($standardClockOutTime);

        $attendance->update([
            'clock_out' => $clockOutTime,
            'hours_worked' => $hoursWorked,
            'remarks' => $leftEarly ? 'Left early' : 'Completed work hours'
        ]);

        return response()->json(['message' => 'Clock-out successful.', 'hours_worked' => $hoursWorked], 200);
    }


    // Fetch attendance history for an employee
    public function getAttendanceHistory(Request $request)
    {
        // Get the authenticated employee
        $employee = Auth::user();

        // Fetch all attendance records for the authenticated employee, ordered by date (latest first)
        $attendanceHistory = Attendance::where('employee_id', $employee->id)
            ->orderBy('date', 'desc')
            ->get();

        // Return the attendance records in a JSON response
        return response()->json([
            'status' => 'success',
            'attendance_records' => $attendanceHistory,
        ], 200);
    }
}
