<x-app-layout>
    <main class="m-5 mt-20">
        <!-- Route for LeaveType -->
        <div class="container mx-auto px-6 py-8">
            <div class="flex justify-end space-x-4">
                @can('LeaveType create')
                <a href="{{ route('admin.leavetype.create') }}"
                    class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Add Leave Type
                </a>
                @endcan
            </div>
        </div>

        <!-- Add your leave type HTML here -->
        <div class="container mx-auto">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-4">
                    <div id="leave_type"></div>
                </div>
            </div>
        </div>

        <!-- Display Leave Types Here -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-5">
            <h2 class="text-2xl font-bold mb-4">Leave Types</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requires Attachment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auto Increase Entitlement</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Increase Rate</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($leaveTypes as $leaveType)
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b border-gray-200">
                            {{ $leaveType->employee->name }}
                            <br>
                            <p><span><strong class="text-blue-500">{{ $leaveType->employee->staff_id}}</strong></span> | <span> <strong class="text-blue-500">{{ $leaveType->employee->full_name}}</strong></span> | <span><strong class="text-blue-500">{{ $leaveType->employee->gender}}</strong></span></p>
                            @foreach($leaveType->employee->roles as $role)
                            <!-- {{ $role->name }} -->
                            <p class="text-xs">joined date:{{ $leaveType->employee->joined_date}}</p>
                            <p class="text-xs">{{ $leaveType->employee->department->name ?? 'No department'}} | {{ $leaveType->employee->position->name ?? 'No position'}}</p>
                            @if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $leaveType->leave_name }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $leaveType->requires_attachment ? 'Yes' : 'No' }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $leaveType->auto_increase_entitlement ? 'Yes' : 'No' }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $leaveType->increase_rate }} days/year</td>
                        <td class="py-4 px-6 border-b border-gray-200 text-right">
                            @can('LeaveType edit')
                            <a href="{{ route('admin.leavetype.edit', $leaveType->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600 text-white">Edit</a>
                            @endcan

                            @can('LeaveType delete')
                            <form action="{{ route('admin.leavetype.destroy', $leaveType->id) }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <button class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-600">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</x-app-layout>