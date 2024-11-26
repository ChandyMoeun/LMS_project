<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Position;

class DempartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ====> Eager load the positions for each department and manager <=======
        $departments = Department::with(['positions', 'manager:id,full_name'])->paginate(4);

        // Customize the data before returning
        $departmentsData = $departments->map(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'manager_name' => $department->manager ? $department->manager->full_name : null,
                'positions' => $department->positions->pluck('name'), // Assuming positions has a 'name' field
            ];
        });

        // Return the customized data as a JSON response
        return response()->json([
            'data' => $departmentsData,
        ]);
    }

    public function show($departmentId)
    {
        // Fetch department with positions and count the number of employees in each position
        $department = Department::with(['positions' => function ($query) {
            $query->withCount('employees');  // Count the number of employees in each position
        }])->findOrFail($departmentId);

        return response()->json($department);
    }


    // public function showChart()
    // {
    //     // Fetch data from the API
    //     $response = Http::get('http://127.0.0.1:8000/api/departments');

    //     // Check if the response is successful
    //     if ($response->successful()) {
    //         // Decode JSON data
    //         $departments = $response->json()['data'];
    //     } else {
    //         // Handle error or set $departments to an empty array
    //         $departments = [];
    //     }

    //     // Pass the data to the view
    //     return view('dashboard', compact('departments'));
    // }



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
