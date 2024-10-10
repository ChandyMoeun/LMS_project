<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar_holiday extends Model
{
    use HasFactory;

    protected $table = 'calendar_holidays'; // Ensure this matches your table name
    protected $fillable = ['holiday_name', 'from_date', 'to_date', 'holiday', 'description'];


    public function calendarGroups()
    {
        return $this->hasMany(CalendarGroup::class, 'calendar_holiday_id');
    }
}
