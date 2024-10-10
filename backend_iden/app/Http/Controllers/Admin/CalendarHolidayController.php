<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar_holiday;

class CalendarHolidayController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:Calendar access|Calendar create|Calendar edit|Calendar delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Calendar create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Calendar edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Calendar delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all calendar holidays
        $holidays = Calendar_holiday::all();
        // dd($holidays);
        // return $holidays;
        
        // Pass the data to the view
        // return view('calendar.index', compact('holidays'));
        return view('calendar.show', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.new_holiday');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'holiday' => 'required',
            'description' => 'required',
        ]);

        Calendar_holiday::create($request->all());

        return redirect()->route('admin.calendar_workday.index')->with('success', 'Calendar holiday created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Calendar_holiday  $calendarHoliday
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar_holiday $calendarHoliday)
    {
        return view('calendar.index', compact(['calendarHolidays' => $calendarHoliday]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Calendar_holiday  $calendarHoliday
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendarHoliday = Calendar_holiday::findOrFail($id);
        return view('calendar.edit_holiday', compact('calendarHoliday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Calendar_holiday  $calendarHoliday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'holiday_name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'holiday' => 'required',
            'description' => 'required',
        ]);

        $calendarHoliday = Calendar_holiday::findOrFail($id);
        $calendarHoliday->update($request->all());

        return redirect()->route('admin.calendar_workday.index')->with('success', 'Calendar holiday updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Calendar_holiday  $calendarHoliday
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendarHoliday = Calendar_holiday::findOrFail($id);
        $calendarHoliday->delete();

        return redirect()->route('admin.calendar_workday.index')->withSuccess('Calendar holiday deleted successfully!');
    }
}
