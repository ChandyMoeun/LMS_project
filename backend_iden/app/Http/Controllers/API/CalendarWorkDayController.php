<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Calendar_work_day;
use Illuminate\Http\Request;

class CalendarWorkDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CalendarWorkday()
    {
        $calendarWorkday = Calendar_work_day::all();
        return response()->json($calendarWorkday);
    
    }

}
