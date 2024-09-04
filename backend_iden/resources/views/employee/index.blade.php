<x-app-layout>

    <main class="mt-20">
        <div class="p-10 ">
            <!-- Employee Management Header -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold">Employee Management</h2>
                <p class="text-gray-600">Total Employees: </p>
            </div>

            <!-- Search and Filter -->
            <div class="flex justify-between mb-4">
                <input type="text" placeholder="Search employee by name..." class="border rounded p-2 h-10 w-1/3">
                <div class="flex items-center space-x-2">
                    <select class="border rounded p-2">
                        <option>All positions</option>
                        <option>Front-end</option>
                        <option>Back-end</option>
                        <option>Full-stack</option>
                    </select>
                    <button class="p-2 flex items-center bg-blue-500 text-white font-bold px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors">

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
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <td class="p-3 text-center">{{ $employee->staff_id }}</td>
                            <td class="p-3">
                                <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full w-8 h-8">
                            </td>
                            <td class="p-3 text-center">{{ $employee->full_name }}</td>
                            <td class="p-3 text-blue-600 text-center">{{ $employee->email }}</td>
                            <td class="p-3 text-center">{{ $employee->position->name}}</td>
                            <td class="p-3 text-center">
                                <a href="#" class="text-gray-600 hover:text-gray-400">More</a>
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

</x-app-layout>