<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar_work_day;
use App\Models\Calendar_holiday;

class CalendarHolidayController extends Controller
{
    public function calendarHoliday()
    {
        $calendarGroup = Calendar_holiday::all();
        return response()->json($calendarGroup);
    }

}
