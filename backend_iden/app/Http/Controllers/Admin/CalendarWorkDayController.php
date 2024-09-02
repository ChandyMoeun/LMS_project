<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar_work_day;
use Auth;

class CalendarWorkDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('role_or_permission:Calendar access|Calendar create|Calendar edit|Calendar delete', ['only' => ['index', 'show']]);
    //     $this->middleware('role_or_permission:Calendar create', ['only' => ['create', 'store']]);
    //     $this->middleware('role_or_permission:Calendar edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('role_or_permission:Calendar delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch calendar workdays data from your model
        $calendarWorkDays = Calendar_work_day::all();

        // Pass the data to the view
        return view('calendar.index', compact('calendarWorkDays'));
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
        // $request->validate([
        //     'date' => 'required|date',
        //     'start_time' => 'required|date_format:H:i',
        //     'end_time' => 'required|date_format:H:i|after:start_time',
        // ]);

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
        return view('calendar_workday.show', ['calendarWorkDay' => $calendarWorkDay]); // Adjust view accordingly
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar_work_day $calendarWorkDay)
    {
        return view('calendar_workday.edit', ['calendarWorkDay' => $calendarWorkDay]); // Adjust view accordingly
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar_work_day $calendarWorkDay)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $calendarWorkDay->update($request->only(['date', 'start_time', 'end_time']));

        return redirect()->route('admin.calendar_workday.index')->withSuccess('Calendar workday updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Calendar_work_day  $calendarWorkDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar_work_day $calendarWorkDay)
    {
        $calendarWorkDay->delete();
        return redirect()->route('admin.calendar_workday.index')->withSuccess('Calendar workday deleted successfully!');
    }
}
