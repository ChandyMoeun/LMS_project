<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    public function users(){
        return $this->belongsToMany(User::class,'calendar_group_user');
    }

    public function calendarWorkDay()
    {
        return $this->belongsTo(Calendar_work_day::class);
    }

    public function calendarHolidays()
    {
        return $this->hasMany(Calendar_holiday::class);
    }
}
