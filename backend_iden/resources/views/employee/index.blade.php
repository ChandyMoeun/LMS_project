<x-app-layout>

    <main class="mt-20">
        <!-- Employee Management Header -->
        <div class="d-flex border-b-2 border-gray-300 h-20 pl-20 items-center mb-10">
            <h1 class="font-bold text-3xl mt-5 w-1/3 hover:text-yellow-400"><b>Employee Management</b></h1>
            <p class="text-gray-600 pl-6">Total Employees: </p>
        </div>
        <div class="p-20">
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
                    <button class="p-2 flex items-center bg-black text-white font-bold px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">
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
                        <tr class="bg-gray-800 text-white">
                            <th class="p-3 text-center">Staff_id</th>
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
                            <td class="p-3 text-center">{{ $employee->staff_id }}</td>
                            <td class="p-3">
                                <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full w-8 h-8">
                            </td>
                            <td class="p-3 text-center">{{ $employee->full_name }}</td>
                            <td class="p-3 text-blue-600 text-center">{{ $employee->email }}</td>
                            <td class="p-3 text-center">{{ $employee->position->name}}</td>
                            <td class="p-3 text-center">
                                <a href="employee/profile/{{$employee->id}}" class="text-gray-600 hover:text-gray-400">More</a>
                                @can('Employee edit')
                                <a href="{{route('admin.employee.edit',$employee->id)}}" class="ml-2 text-blue-600 hover:text-blue-400">Update</a>
                                @endcan
                                @can('Employee delete')
                                <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="ml-2 text-red-600 hover:text-red-400">Delete</button>
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
    <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-end mb-4">
                    @can('Employee create')
                    <a href="{{ route('admin.employee.create') }}" class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors">New Employee</a>
                    @endcan
                </div>

                <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff ID</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined Date</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entitle Date</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reporting Line</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Positions</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departments</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @can('Employee access')
                            @foreach($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $employee->staff_id }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900"><img src="/images/{{ auth()->user()->profile }}" alt="Your avatar"></td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->full_name }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->gender }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->email }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->dob }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->joined_date }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->entitled_calendar }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->reporting_line }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->position->name ?? 'No position available' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">{{ $employee->department->name ?? 'No department available' }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500">
                                    @foreach($employee->roles as $role)
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-semibold leading-none text-white bg-gray-600 rounded-full">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right">
                                    @can('Employee edit')
                                    <a href="{{ route('admin.employee.edit', $employee) }}" class="text-green-600 hover:text-green-800">Edit</a>
                                    @endcan

                                    @can('Employee delete')
                                    <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
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
    </div>


</x-app-layout>