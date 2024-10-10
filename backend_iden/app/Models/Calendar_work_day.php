<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar_work_day extends Model
{
    use HasFactory;
    protected $table = 'calendar_work_days';

    protected $fillable = ['start_time', 'end_time','work_day','day_type'];

    
    public function calendarGroups()
    {
        return $this->hasMany(CalendarGroup::class, 'calendar_work_day_id');
    }
}
