<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Auth;
use Illuminate\Contracts\Mail\Attachable;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('role_or_permission:Attendance access|Attendance create|Attendance edit|Attendance delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Attendance create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Attendance edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Attendance delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    
        $attendances = Attendance::with('employee')->get();
        return view('attendance.index', compact('attendances'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
