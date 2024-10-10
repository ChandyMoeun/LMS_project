<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarGroup extends Model
{
    use HasFactory;
    protected $fillable = ['calendar_name','for_year','active','calendar_holiday_id','calendar_work_dia_id'];
    
    public function users(){
        return $this->belongsToMany(User::class,'calendar_group_user');
    }

    public function workDay()
    {
        return $this->belongsTo(Calendar_work_day::class, 'calendar_work_day_id');
    }

    public function holiday()
    {
        return $this->belongsTo(Calendar_holiday::class, 'calendar_holiday_id');
    }
}
