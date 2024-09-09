<x-app-layout>
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