<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model

{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'used',
        'available',
    ];

    // Define relationships if needed
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
    
     /**
     * Scope to get leave balance for a specific employee and leave type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $employeeId
     * @param int $leaveTypeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForEmployeeAndLeaveType($query, $employeeId, $leaveTypeId)
    {
        return $query->where('employee_id', $employeeId)
                     ->where('leave_type_id', $leaveTypeId);
    }
}
