<x-app-layout>
    <main class="mt-10 p-5">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-15 items-center">
            <a href="/admin/mail#">
                <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-2/12"><b>Leave Types</b></h1>
        </div>
        <div class="container mx-auto px-6 py-1">
            <!-- Create new LeaveType -->
            <div class="flex justify-end">
                @can('LeaveType create')
                <a href="{{ route('admin.leavetype.create') }}"
                    class="bg-yellow-400 text-white font-bold mt-3 px-2 py-1 rounded focus:outline-none shadow hover:bg-black transition-colors">
                    Add New Type
                </a>
                @endcan
            </div>
            <!--leave type-->
            <div class="container mx-auto mt-5">
                <h6 class="text-center text-2xl font-bold mb-6">All Leave Types</h6>
                <table class="min-w-full divide-y mb-5 divide-gray-200" style=" box-shadow:rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                    <thead class="bg-black">
                        <tr>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Employee</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Leave Type</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Requires Attachment</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Auto Increase Entitlement</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Increase Rate</th>
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Actions</th>
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
                            <td class="py-4 px-6 text-center border-b border-gray-200">{{ $leaveType->requires_attachment ? 'Yes' : 'No' }}</td>
                            <td class="py-4 px-6 text-center border-b border-gray-200">{{ $leaveType->auto_increase_entitlement ? 'Yes' : 'No' }}</td>
                            <td class="py-4 px-6 text-center border-b border-gray-200">{{ $leaveType->increase_rate }} days/year</td>
                            <td class="py-4 px-6 border-b border-gray-200 text-right">
                                @can('LeaveType edit')
                                <a href="{{ route('admin.leavetype.edit', $leaveType->id) }}" class="text-white font-bold py-1 px-3 rounded text-xs bg-black hover:bg-yellow-400 text-white">Edit</a>
                                @endcan

                                @can('LeaveType delete')
                                <form action="{{ route('admin.leavetype.destroy', $leaveType->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="text-white font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</x-app-layout>