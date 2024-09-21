<x-app-layout>

    <div class="mt-10 p-5 bg-white">

        <div class="container mx-auto px-6 py-8">
            <!----------- alert code -------------------->
            <div class="button" style="margin: 50px;">
                <div id="taostBox" style="display: none; position: absolute; top:11%; right:2%; display:flex; align-items:flex-end; flex-direction:column; overflow:hidden; padding:20px; width: 25%;">
                    <div id="alert" role="alert" class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                        Welcome To Dashboard! How are you?
                        <button onclick="HideAlert()" class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute" style="right: 10px;" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <style>
                    .taost {
                        background-color: #fff;
                        width: 100%;
                        padding: 3%;
                        height: 5%;
                        font-weight: 900;
                        margin: 15px 0;
                        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                </style>
            </div>
            <script>
                let taostBox = document.getElementById('taostBox');

                function ShowAlert() {
                    taostBox.style.display = 'block';

                    setTimeout(() => {
                        taostBox.style.display = 'none'
                    }, 4000);
                }

                function HideAlert() {
                    taostBox.style.display = 'none';
                }
                ShowAlert();
            </script>
            <!----------- // alert code //-------------------->

            <div style="border-bottom: #B0B0B0 1px solid;  display: flex; justify-content:center; flex-direction: row; height:30vh; width: 100%;">
                <div style="margin-bottom: 10px; border-right: #B0B0B0 1px solid; width: 55%; display: flex; justify-content:center;">
                    <div class=" bg-yellow-300" style="margin-top: 30px; margin-left: 70px; width: 50%; height:75%; display: flex; flex-direction: row; box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
                        <img src="../images/employees.png" style="margin-left: 8px; width: 100px; height:50%; display: flex; align-self:center;">
                        <div class="ml-1">
                            <h4 class="font-bold mt-6 "><b>Employees</b></h4>
                            <p>All :{{$totalEmployees}}</p>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 10px; width: 55%; display: flex; justify-content:center;">
                    <div class=" bg-yellow-300" style="margin-top: 30px; margin-right: 70px; width: 50%; height:75%; display: flex; flex-direction: row; box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
                        <img src="../images/Leave.png" style="margin-left: 25px; width: 75px; height:9vh; display: flex; align-self:center;">
                        <div>
                            <h4 class="font-bold mt-6 ml-3 "><b>Leaveds</b></h4>

                            <p class="ml-1"><em>This week : </em></p>

                        </div>
                    </div>
                </div>
            </div>

            <!--............................// Chart js // total employee chart ..............................  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <h1 class="text-4xl">Employee Chart</h1>
            <style>
                /* Center the chart on the page */
                .chart-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-bottom: 90px;
                }

                canvas {
                    background: #ECECEC;
                    width: 100%;
                    box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
                    padding: 3%;
                    border-radius: 10px;
                }

                h1 {
                    display: flex;
                    justify-content: center;
                    padding: 3%;
                    font-weight: bold;
                }
            </style>
            <!-- Chart Container -->
            <div class="chart-container">
                <canvas id="employeeChart"></canvas>
            </div>
            <!-- Chart Script -->
            <script>
                var xValues = ["IT", "Production", "Finance", "Creative"];
                var yValues = [24, 10, 2, 4];
                var barColors = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797",
                    "#e8c3b9"
                ];

                new Chart("employeeChart", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Employees by section"
                        }
                    }
                });
            </script>

            <!--............................// Chart js // total employee chart ..............................  -->

            <!--.......................... employees list of leave......................... -->
            <style>
                .table th,
                .table td {
                    vertical-align: middle;
                    text-align: center;
                }

                .profile-img {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                }

                .table thead th {
                    background-color: black;
                    color: white;
                }

                .table-striped tbody tr:nth-of-type(odd) {
                    background-color: #f8f9fa;
                }

                .section-header {
                    text-align: center;
                    font-weight: bold;
                    font-size: 24px;
                    margin-top: 30px;
                    margin-bottom: 30px;
                }
            </style>

            <!-- employees take leaves -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-100 border border-gray-100">
                    <thead>
                        <tr class="bg-black text-white text-xs">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Profile</th>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Position</th>
                            <th class="py-2 px-4 border-b">From | To</th>
                            <th class="py-2 px-4 border-b">Approver</th>
                            <th class="py-2 px-4 border-b">Sub-approver</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Detail</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each employee and generate table rows -->
                        @can('Leave access')
                        @foreach($leaveRequests as $leaveRequest)
                        <tr class="hover:bg-white text-xs">
                            <td class="py-2 px-4 border-b">{{$leaveRequest->employee->staff_id ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($leaveRequest->employee->profile)
                                <img src="{{ asset('images/' . $leaveRequest->employee->profile) }}" alt="Profile Image" class="w-12 h-12 rounded-full object-cover">
                                @else
                                <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile" class="w-12 h-12 rounded-full object-cover">
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $leaveRequest->employee->full_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{$leaveRequest->leaveType->leave_name ?? 'N/A'}}</td>
                            <td class="py-2 px-4 border-b">position</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($leaveRequest->from_date)->format('Y-m-d') }}|{{ $leaveRequest->to_date ? \Carbon\Carbon::parse($leaveRequest->to_date)->format('Y-m-d') : '-' }}</td>
                            <td class="py-2 px-4 border-b">@if($leaveRequest->status === 'approved')
                                {{ $leaveRequest->approver->full_name ?? 'no name' }}
                                @elseif($leaveRequest->status === 'rejected')
                                {{ $leaveRequest->rejector->full_name ?? 'no name'}}
                                @else
                                Pending
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b text-xs">XXX</td>
                            <td class="py-2 px-4 border-b text-xs"> @if($leaveRequest->status == 'pending')
                                <span class="bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-semibold">Pending</span>
                                @elseif($leaveRequest->status == 'approved')
                                <span class="bg-green-400 text-white px-2 py-1 rounded-full text-xs font-semibold">Approved</span>
                                @else
                                <span class="bg-red-400 text-white px-2 py-1 rounded-full text-xs font-semibold">Rejected</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b text-xs">
                                <a href="{{ route('admin.leave.show', $leaveRequest->id) }}" class="text-blue-500 hover:underline">More</a>
                            </td>


                            <td class="py-2 px-4 border-b text-xs">
                                <!-- View button to toggle the visibility -->
                                <button type="button" class="text-blue-600 hover:text-blue-800 font-semibold" onclick="toggleButtons({{ $leaveRequest->id }})">
                                    Views
                                </button>

                                <!-- Hidden buttons (Edit, Approve, Reject) -->
                                <div id="action-buttons-{{ $leaveRequest->id }}" class="mt-2 space-x-4 hidden">
                                    @can('Leave edit')
                                    <a href="{{ route('admin.leave.edit', $leaveRequest->id) }}" class="text-green-600 hover:text-green-800 font-semibold transition-colors duration-200 text-xs">
                                        Edit
                                    </a>
                                    @endcan

                                    @can('Leave edit')
                                    <form action="{{ route('admin.leave.approve', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 transition-all duration-300 ease-in-out font-semibold text-xs">
                                            Approve
                                        </button>
                                    </form>
                                    @endcan

                                    @can('Leave edit')
                                    <form action="{{ route('admin.leave.reject', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition-all duration-300 ease-in-out font-semibold text-xs">
                                            Reject
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endcan

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleButtons(id) {
        const actionButtons = document.getElementById(`action-buttons-${id}`);
        if (actionButtons.classList.contains('hidden')) {
            actionButtons.classList.remove('hidden');
        } else {
            actionButtons.classList.add('hidden');
        }
    }
</script>