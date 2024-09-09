<x-app-layout>
    <main class="mt-20 px-4 py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Attendance Records</h3>
                    <p class="mt-1 text-sm text-gray-500">Detailed attendance records for all employees.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hours Worked</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($attendances as $attendance)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $attendance->employee->full_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $attendance->date }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($attendance->status) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $attendance->clock_in }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $attendance->clock_out }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $attendance->hours_worked }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $attendance->remarks }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>