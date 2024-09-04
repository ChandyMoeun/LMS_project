<x-app-layout>
    <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                    @can('Employee create')
                    <a href="{{route('admin.employee.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Employee</a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Staff_id</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">User Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Gender</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Email</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Date of birth</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Joined Date</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Entitle Date</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Reporting_line</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Positions</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Departments</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Role</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @can('Employee access')
                            @foreach($employees as $employee)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->staff_id }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->full_name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->gender }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->email }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->dob }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->joined_date }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->entitled_calendar }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->reporting_line }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->position->name ?? 'No position available'}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $employee->department->name ?? 'No position available' }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    @foreach($employee->roles as $role)
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light text-right">
                                    @can('Employee edit')
                                    <a href="{{route('admin.employee.edit', $employee)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan

                                    @can('Employee delete')
                                    <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
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
    </div>
</x-app-layout>