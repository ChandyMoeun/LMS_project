<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'staff_id',
        'full_name',
        'gender',
        'email',
        'password',
        'dob',
        'joined_date',
        'entitled_calendar',
        'reporting_line',
        'profile_image',
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
        'dob' => 'date',
        'joined_date' => 'date',
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
     * Define the relationship with the CalendarGroup model.
     */
    public function calendarGroup()
    {
        return $this->belongsTo(CalendarGroup::class, 'entitled_calendar');
    }

    /**
     * Define the relationship with another Employee as the reporting line.
     */
    public function reportingLine()
    {
        return $this->belongsTo(Employee::class, 'reporting_line');
    }
}
