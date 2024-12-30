<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar_work_day;
use App\Models\Calendar_holiday;
use Auth;

class CalendarWorkDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
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
        // Fetch all records from the calendar_work_days table
        $calendarWorkDays = Calendar_work_day::all();

        // Fetch all records from the calendar_holidays table
        $calendarHolidays = Calendar_holiday::all();

        // Pass both workdays and holidays data to the view
        return view('calendar.index', compact('calendarWorkDays', 'calendarHolidays'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.new_work_day'); // Only return view for creating calendar workday
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
            'work_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day_type' => 'required',
        ]);

        $data = $request->only(['start_time', 'end_time', 'work_day', 'day_type']);
        $data['user_id'] = Auth::user()->id; // Optional: Set the user_id if needed

        Calendar_work_day::create($data);

        return redirect()->route('admin.calendar_workday.index')->withSuccess('Calendar workday created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar_work_day $calendarWorkDay)
    {
        return view('calendar_workday.index', ['calendarWorkDays' => $calendarWorkDay]); // Adjust view accordingly
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendarWorkDay = Calendar_work_day::findOrFail($id);
        return view('calendar.edit', compact('calendarWorkDay'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'work_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day_type' => 'required',
        ]);

        $calendarWorkDay = Calendar_work_day::findOrFail($id);
        $calendarWorkDay->update($request->all());

        return redirect()->route('admin.calendar_workday.index')->with('success', 'Calendar workday updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the Calendar_work_day by ID
        $calendarWorkDay = Calendar_work_day::findOrFail($id);

        // Delete the found record
        $calendarWorkDay->delete();

        // Redirect back to the index with a success message
        return redirect()->route('admin.calendar_workday.index')->withSuccess('Calendar workday deleted successfully!');
    }
}
