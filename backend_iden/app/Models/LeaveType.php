<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $table = 'leave_types';
    protected $fillable = [
        'leave_name',
        'employee_id',
        'requires_attachment',
        'auto_increase_entitlement',
        'increase_rate'
    ];


    public function leaves()
    {
        return $this->hasMany(LeaveType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id'); // Adjust the foreign key if necessary
    }
    public function department()
    {
        return $this->belongsTo(Department::class); // Adjust based on actual relationship
    }

    public function position()
    {
        return $this->belongsTo(Position::class); // Adjust based on actual relationship
    }
}
