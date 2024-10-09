<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['employee_id', 'message', 'notification_type', 'leave_request_id', 'sent_at'];

    // Relationship to Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Relationship to Leave Request
    public function leaveRequest()
    {
        return $this->belongsTo(LeaveRequest::class);
    }
}
