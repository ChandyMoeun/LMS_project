<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    // Specify which attributes are mass assignable
    protected $fillable = [
        'employee_id',     // Add this line
        'leaveType_id',
        'half_day_type',
        'start_time',
        'end_time',
        'from_date',
        'to_date',
        'reason',
        'duration_leave',
        'approved_by',
        'rejected_by',
        'requested_at',
        'approved_at',
        'attachment',
        'status',
        'total_requested_days',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    


    // In LeaveRequest.php model
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leaveType_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    public function rejector()
    {
        return $this->belongsTo(Employee::class, 'rejected_by');
    }
    
}
