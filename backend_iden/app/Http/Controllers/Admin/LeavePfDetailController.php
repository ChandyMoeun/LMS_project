<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Auth;


class LeavePfDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
         $this->middleware('role_or_permission:LeaveType access|LeaveType create|LeaveType edit|LeaveType delete', ['only' => ['index','show']]);
         $this->middleware('role_or_permission:LeaveType create', ['only' => ['create','store']]);
         $this->middleware('role_or_permission:LeaveType edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:LeaveType delete', ['only' => ['destroy']]);
     }

    public function index()
    {
        return view('employee.more.index');
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