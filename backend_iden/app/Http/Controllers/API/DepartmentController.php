<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use App\Models\Position;

class DepartmentController extends Controller
{
    //===>Display a listing of the resource.<===
    public function index()
    {
        // ====> Eager load the positions for each department and manager <=======
        $departments = Department::with(['positions', 'manager:id,full_name'])->paginate(4);
        // ===>Customize the data before returning<===
        $departmentsData = $departments->map(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'manager_name' => $department->manager ? $department->manager->full_name : null,
                'positions' => $department->positions->pluck('name'), // Assuming positions has a 'name' field
            ];
        });
        // ===>Return the customized data as a JSON response<===
        return response()->json([
            'data' => $departmentsData,
        ]);
    }

    public function show($departmentId)
    {
        // ===>Fetch department with positions and count the number of employees in each position<===
        $department = Department::with(['positions' => function ($query) {
            $query->withCount('employees');  // Count the number of employees in each position
        }])->findOrFail($departmentId);

        return response()->json($department);
    }
}