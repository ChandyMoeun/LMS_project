<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $guard_name = 'web';  // Specify the guard

    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'staff_id',
        'gender',
        'full_name',
        'email',
        'profile',
        'password',
        'dob',
        'joined_date',
        'entitled_calendar',
        'reporting_line',
        'position_id',
        'department_id',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Define the relationship with the Position model.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Define the relationship with the Department model.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

     /**
     * Define the relationship with another Employee as the reporting line.
     */
   


    /**
     * Define the relationship with the CalendarGroup model.
     */
    public function calendarGroup()
    {
        return $this->belongsTo(CalendarGroup::class, 'entitled_calendar');
    }
    
    /**
     * Define the relationship with the Employee model.
     */
    public function leaveTypes()
    {
        return $this->hasMany(LeaveType::class, 'employee_id'); // Adjust the foreign key if necessary
    }

    public function leaveRequests(){
        return $this->hasMany(LeaveRequest::class, 'employee_id'); // Adjust the foreign key if necessary
    }
   
}
