<x-app-layout>
    <main class="mt-10 p-10">
        <div class="d-flex border-b-2 px-8 border-gray-300 h-15 items-center">
            <h1 class="font-bold text-3xl mt-10 hover:text-yellow-400 w-3/12"><b>Admin Attendance</b></h1>
        </div>
        <div class="mt-16">
            <div class="printpage flex justify-end mr-8 mb-4 gap-3">
                <button onclick="Export()" class="border-none bg-blue-600 flex px-2 py-2 text-white rounded-lg shadow-md hover:bg-yellow-400">Export
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </button>
                <button onclick="printSection()" class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-400">Print</button>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-yellow-400">Attendance Records</h3>
                    <p class="mt-1 text-sm text-gray-500">Detailed attendance records for all employees.</p>
                </div>
                <div id="attendance_list" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Check In</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Check Out</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Hours Worked</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Remarks</th>
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

    <!-- JavaScript Functions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function Export() {
            const element = document.getElementById("attendance_list");
            const options = {
                margin:       0.5,
                filename:     'attendance_record.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(options).from(element).save();
        }

        function printSection() {
            const printContent = document.getElementById('attendance_list').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload();
        }
    </script>
</x-app-layout>
