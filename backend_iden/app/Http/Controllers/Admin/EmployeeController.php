<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
         $this->middleware('role_or_permission:Employee access|Employee create|Employee edit|Employee delete', ['only' => ['index','show']]);
         $this->middleware('role_or_permission:Employee create', ['only' => ['create','store']]);
         $this->middleware('role_or_permission:Employee edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:Employee delete', ['only' => ['destroy']]);
     }

    public function index()
    {
        return view('employee.index');
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
