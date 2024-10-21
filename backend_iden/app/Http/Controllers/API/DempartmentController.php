<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DempartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // $department = Department::all();
    //     // return response()->json($department);
    //     // Get all departments with the count of employees in each department
    //     $departments = Department::withCount('employees')->get();

    //     // Format the response to include department name and employee count
    //     $departmentData = $departments->map(function ($department) {
    //         return [
    //             'department' => $department->name,   // Assuming 'name' is the department name field
    //             'employees' => $department->employees_count // 'employees_count' from withCount()
    //         ];
    //     });

    //     // Return the data as a JSON response
    //     return response()->json($departmentData);
    // }

    public function index()
    {
        $departments = Department::withCount('employees')->get();
        return response()->json(['data' => $departments]);  // Return as JSON
    }

    public function showChart()
    {
        // Fetch data from the API
        $response = Http::get('http://127.0.0.1:8000/api/departments');

        // Check if the response is successful
        if ($response->successful()) {
            // Decode JSON data
            $departments = $response->json()['data'];
        } else {
            // Handle error or set $departments to an empty array
            $departments = [];
        }

        // Pass the data to the view
        return view('dashboard', compact('departments'));
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
