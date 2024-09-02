<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar_work_day extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'end_time','work_day','day_type'];

    public function calendarGroup(){
        return $this->belongsTo(CalendarGroup::class, 'calendar_id');
    }
}
