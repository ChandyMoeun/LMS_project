<x-app-layout>
    <div class="mt-16 p-5">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <!-- Admin Requites leave -->
            <div class="d-flex border-b-2 border-gray-300 m-5 items-center mb-10">
                <h1 class="font-bold text-3xl mt-5 w-1/3 hover:text-yellow-400"><b>Admin leave</b></h1>
            </div>

            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between mb-4">
                    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search employee..." title="Type in an ID or Name" class="w-2/6 py-2 px-2 h-9 border rounded">
                    @can('Leave create')
                    <a href="{{ route('admin.leave.create') }}" class="bg-black text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-400 transition-colors">Request Leave</a>
                    @endcan
                </div>

                <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                    <table id="myTable" class=" w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr class="header">
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Staff ID</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Name</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Type</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">From</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">To</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Half Day</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">files</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Status</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Total</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Detail</th>
                                <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Approver</th>
                                <th class="py-3 px-2 w-1/12 text-center text-xs text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @can('Leave access')
                            @foreach($leaveRequests as $leaveRequest)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-2 text-sm text-center text-black">{{ $leaveRequest->employee->staff_id ?? 'N/A' }}</td>
                                <td class="py-4 px-2 text-sm text-center text-black">{{ $leaveRequest->employee->full_name ?? 'N/A' }}</td>
                                <td class="py-4 text-center px-2 text-sm text-black">{{ $leaveRequest->leaveType->leave_name ?? 'N/A' }}</td>
                                <td class="py-4 px-2 text-sm text-center text-black">{{ \Carbon\Carbon::parse($leaveRequest->from_date)->format('Y-m-d') }} </td>
                                <td class="py-4 px-2 text-sm text-center text-black">{{ $leaveRequest->to_date ? \Carbon\Carbon::parse($leaveRequest->to_date)->format('Y-m-d') : '-' }}</td>
                                <td class="py-4 px-2 text-sm text-center text-black">
                                    {{ $leaveRequest->half_day_type ? ucfirst($leaveRequest->half_day_type) : ($leaveRequest->start_time && $leaveRequest->end_time ? \Carbon\Carbon::parse($leaveRequest->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($leaveRequest->end_time)->format('H:i')  : '-') }}
                                </td>
                                <td class="py-4 px-2 text-sm text-center text-black">
                                    @if($leaveRequest->attachment)
                                    <a href="{{ asset('storage/attachments/' . $leaveRequest->attachment) }}" target="_blank">
                                        View
                                    </a>
                                    @else
                                    No file
                                    @endif

                                </td>
                                <!-- status -->
                                <td class="py-4 text-center px-2 text-sm">
                                    @if($leaveRequest->status == 'pending')
                                    <span class="bg-yellow-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Pending</span>
                                    @elseif($leaveRequest->status == 'approved')
                                    <span class="bg-green-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Approved</span>
                                    @else
                                    <span class="bg-red-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Rejected</span>
                                    @endif
                                </td>
                                <!-- total leave days -->
                                <td class="py-4 px-2 text-sm text-center text-black">{{ $leaveRequest->total_requested_days }}</td>
                                <!-- detail leave -->
                                <td class="py-4 px-2 text-sm text-center">
                                    <a href="{{ route('admin.leave.show', $leaveRequest->id) }}" class="text-blue-700 hover:text-blue-300 ">
                                        View
                                    </a>
                                </td>

                                <td class="py-4 text-center text-sm text-gray-500">
                                    @if($leaveRequest->status === 'approved')
                                    {{ $leaveRequest->approver->full_name ?? 'no name' }}
                                    @elseif($leaveRequest->status === 'rejected')
                                    {{ $leaveRequest->rejector->full_name ?? 'no name'}}
                                    @else
                                    Pending
                                    @endif
                                </td>
                                <td class="text-sm px-2 font-medium text-center">
                                    <!-- View button to toggle the visibility -->
                                    <button type="button" class="text-blue-700 hover:text-blue-300 font-semibold" onclick="toggleButtons({{ $leaveRequest->id }})">
                                        View Options
                                    </button>

                                    <!-- Hidden buttons (Edit, Approve, Reject) -->
                                    <div id="action-buttons-{{ $leaveRequest->id }}" class=" flex justify-center mt-2 m-2 flex space-x-2">
                                        @can('Leave edit')
                                        <form action="{{ route('admin.leave.approve', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="bg-black text-white px-2 py-2 rounded-md shadow-md hover:bg-yellow-400 transition-all duration-300 ease-in-out font-semibold">
                                                Approve
                                            </button>
                                        </form>
                                        @endcan

                                        @can('Leave edit')
                                        <form action="{{ route('admin.leave.reject', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded-md shadow-md hover:bg-red-400 transition-all duration-300 ease-in-out font-semibold">
                                                Reject
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                                @endforeach
                                @endcan
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function toggleButtons(leaveRequestId) {
        var buttons = document.getElementById('action-buttons-' + leaveRequestId);
        buttons.classList.toggle('hidden'); // Toggle 'hidden' class to show/hide the buttons
    }

    function disableButtons(leaveRequestId) {
        var buttons = document.getElementById('action-buttons-' + leaveRequestId);
        buttons.classList.add('hidden'); // Hide the buttons after form is submitted

        // Disable the buttons within the forms to prevent further clicks
        var forms = buttons.querySelectorAll('form');
        forms.forEach(function(form) {
            var submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true; // Disable the button
            submitButton.classList.add('opacity-50', 'cursor-not-allowed'); // Add visual feedback
        });
    }
    // Filter search employees by name and by id
    function filterTable() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) { // Start at 1 to skip the header row
            var tdId = tr[i].getElementsByTagName("td")[0]; // Staff ID column
            var tdName = tr[i].getElementsByTagName("td")[2]; // Name column
            var idMatch = tdId && tdId.textContent.toUpperCase().indexOf(input) > -1;
            var nameMatch = tdName && tdName.textContent.toUpperCase().indexOf(input) > -1;

            if (idMatch || nameMatch) {
                tr[i].style.display = ""; // Show the row
            } else {
                tr[i].style.display = "none"; // Hide the row
            }
        }
    }
</script>