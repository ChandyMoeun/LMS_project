<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position; // Assuming you have a Position model
use App\Models\Department; // Assuming you have a Department model
use Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Position access|Position create|Position edit|Position delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Position create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Position edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Position delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::with('department')->paginate(4);

        return view('position.index', ['positions' => $positions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all(); // Fetch all departments
        return view('position.new', compact('departments')); // Pass departments to the view
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
        //     'name' => 'required|string|max:255',
        //     'department' => 'required|string|max:255',
        // ]);

        $data = $request->only(['name', 'department_id']); // Only include these fields
        $data['user_id'] = Auth::user()->id; // Optional: Set the user_id if needed
        Position::create($data);

        return redirect()->route('admin.position.index')->withSuccess('Position create successfully!');

        // return redirect()->back()->withSuccess('Position created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)

    {
        $position->load('departments');
        return view('position.show', ['position' => $position]); // Change to the appropriate view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $departments = Department::all(); // Fetch all departments
        return view('position.edit', compact('position', 'departments')); // Pass position and departments to the view
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'department' => 'required|string|max:255',
        // ]);

        $position->update($request->only(['name', 'department'])); // Only update these fields
        return redirect()->route('admin.position.index')->withSuccess('Position updated successfully!');

        // return redirect()->back()->withSuccess('Position updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.position.index')->withSuccess('Position updated successfully!');
        // return redirect()->back()->withSuccess('Position deleted !!!');
    }
}
