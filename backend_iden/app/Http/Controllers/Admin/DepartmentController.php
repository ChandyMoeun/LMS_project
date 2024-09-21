<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Department access|Department create|Department edit|Department delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Department create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Department edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Department delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Eager load the positions for each department
        $departments = Department::with('positions', 'manager')->paginate(4);

        return view('department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('department.new', compact('employees')); // View for creating a new department
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
            'name' => 'required|string|max:255',
            'manager_id' => 'nullable|exists:employees,id',
        ]);

        $data = $request->only(['name','manager_id']);
        $data['user_id'] = Auth::user()->id; // Optional: Set the user_id if needed
        Department::create($data);

        return redirect()->route('admin.department.index')->withSuccess('Department created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('department.show', ['department' => $department]); // View for displaying a single department
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit', ['department' => $department]); // View for editing a department
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($request->only(['name']));

        return redirect()->route('admin.department.index')->withSuccess('Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.department.index')->withSuccess('Department deleted successfully!');
    }
}
