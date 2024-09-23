<x-app-layout>
    <main class="mt-10 p-10 ">
        <div class="d-flex border-b-2 border-gray-300 h-15 items-center">
            <h1 class="font-bold text-3xl mt-10 hover:text-yellow-400 w-3/12"><b>Admin Attendance</b></h1>
        </div>
        <div class="mt-16 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-yellow-400">Attendance Records</h3>
                    <p class="mt-1 text-sm text-gray-500">Detailed attendance records for all employees.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Check In</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Check Out</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Hours Worked</th>
                                <th class="px-6 py-3 text-centeer text-xs font-medium text-white uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($attendances as $attendance)
                            <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 text-left text-sm font-medium text-black font-bold">{{ $attendance->employee->full_name }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $attendance->date }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ ucfirst($attendance->status) }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $attendance->clock_in }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $attendance->clock_out }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $attendance->hours_worked }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $attendance->remarks }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>