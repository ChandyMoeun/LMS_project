<x-app-layout>
    <main class="mt-10 p-12">
        <!-- Employee Management Header -->
        <div class="d-flex border-b-2 border-gray-300 h-15 items-center mb-10">
            <h1 class="font-bold text-3xl mt-3 w-1/3 hover:text-yellow-400"><b>Employee Management</b></h1>
            <p class="text-gray-600 pl-6">Total Employees: {{ $totalEmployees }}</p>
        </div>
        <div class="employee-list">
            <!-- Search and Filter -->
            <div class="flex justify-between mb-4">
                <input type="text" placeholder="Search employee by name..." class="border rounded p-2 h-10 w-1/3">
                <div class="flex items-center justify-end space-x-2 w-2/5">
                    <select class="border rounded p-2 h-9 w-1/3">
                        <option>All positions</option>
                        <option>Front-end</option>
                        <option>Back-end</option>
                        <option>Full-stack</option>
                    </select>
                    <button class="p-2 flex items-center bg-black text-white font-bold px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors">
                        @can('Employee create')
                        <a href="{{route('admin.employee.create')}}" style="display: flex; justify-content: space-evenly; gap:5%;">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg> Add</a>
                        @endcan
                    </button>
                </div>
            </div>
            <!-- Employee Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md rounded">
                    <thead>
                        <tr class="bg-black text-white">
                            <th class="p-3 text-left">Staff_id</th>
                            <th class="p-3 text-left">Profile</th>
                            <th class="p-3 text-center">Name</th>
                            <th class="p-3 text-center">Email</th>
                            <th class="p-3 text-center">Position</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Employee access')
                        @foreach($employees as $employee)
                        <tr class="bg-gray-100 border-b border-gray-200 ">
                            <td class="p-3">{{ $employee->staff_id }}</td>
                            <td class="p-3">
                                @if($employee->profile)
                                <img src="{{ asset('images/' . $employee->profile) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover">
                                @else
                                <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile" class="w-12 h-12 rounded-full object-cover">
                                @endif
                            </td>
                            <td class="p-3 text-center">{{ $employee->full_name }}</td>
                            <td class="p-3 text-blue-600 text-center">{{ $employee->email }}</td>
                            <td class="p-3 text-center">{{ $employee->position->name ?? 'No position'}}</td>
                            <td class="text-center w-3/12">
                                @can('Employee edit')
                                <a href="{{route('admin.employee.show',$employee->id)}}" class="text-white px-2 py-1 border-solid border-1 border-indigo-600 rounded-lg bg-blue-600 hover:bg-blue-400">More</a>
                                @endcan
                                @can('Employee edit')
                                <a href="{{route('admin.employee.edit',$employee->id)}}" class="ml-2 text-white px-2 py-1 border-solid border-1 border-indigo-600 rounded-lg bg-black hover:bg-yellow-400">Update</a>
                                @endcan
                                @can('Employee delete')
                                <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="ml-2 text-white px-2 py-1 border-solid border-1 border-indigo-600 rounded-lg bg-red-600 hover:bg-red-400">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>