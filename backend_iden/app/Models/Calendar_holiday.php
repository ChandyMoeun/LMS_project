<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar_holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'holiday_name',
        'from_date',
        'to_date',
        'holiday',
        'description',
    ];

    public function calendarGroup()
    {
        return $this->belongsTo(CalendarGroup::class);
    }
}
