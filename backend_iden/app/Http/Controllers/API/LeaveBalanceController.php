<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveBalance;
use App\Models\LeaveType;

class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all leave balances
        // return LeaveBalance::with('leaveType')->get();
        return LeaveBalance::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'used' => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
        ]);

        return LeaveBalance::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return LeaveBalance::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leaveBalance = LeaveBalance::findOrFail($id);

        $request->validate([
            'used' => 'integer|min:0',
            'available' => 'integer|min:0',
        ]);

        // Update used and available values
        $leaveBalance->update($request->only(['used', 'available']));

        return $leaveBalance;
    }

    /**
     * Calculate and update available leave balances for a specific employee.
     *
     * @param int $employeeId
     * @return \Illuminate\Http\Response
     */
    public function updateLeaveBalances(int $employeeId)
    {
        // Get all leave types
        $leaveTypes = LeaveType::all();

        foreach ($leaveTypes as $leaveType) {
            // Find the leave balance for the employee and leave type
            $leaveBalance = LeaveBalance::firstOrCreate(
                ['employee_id' => $employeeId, 'leave_type_id' => $leaveType->id],
                ['used' => 0, 'available' => 0] // Default values if not exists
            );

            // Update the available balance
            $leaveBalance->available += $leaveType->increase_rate;

            // Save the updated balance
            $leaveBalance->save();
        }

        return response()->json([
            'message' => 'Leave balances updated successfully.',
            'employee_id' => $employeeId,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leaveBalance = LeaveBalance::findOrFail($id);
        $leaveBalance->delete();

        return response()->json(['message' => 'Leave balance deleted successfully.']);
    }
}
