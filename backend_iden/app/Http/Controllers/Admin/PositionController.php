<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
         $this->middleware('role_or_permission:Position access|Position create|Position edit|Position delete', ['only' => ['index','show']]);
         $this->middleware('role_or_permission:Position create', ['only' => ['create','store']]);
         $this->middleware('role_or_permission:Position edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:Position delete', ['only' => ['destroy']]);
     }

    public function index()
    {
        return view('position.index');
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
