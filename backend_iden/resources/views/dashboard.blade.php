<x-app-layout>

    <div class="mt-10 p-10 bg-white">

        <div class="container mx-auto px-6 py-8">
            <!----------- alert code -------------------->
            <div class="button" style="margin: 50px;">
                <div id="taostBox" style="display: none; position: absolute; top:11%; right:2%; display:flex; align-items:flex-end; flex-direction:column; overflow:hidden; padding:20px; width: 25%;">
                    <div id="alert" role="alert" class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                        Welcome To Addmin Dashboard! How are you?
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
                            <p>All :</p>
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
                var yValues = [2, 10, 2, 4];
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

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-100 border border-gray-100">
                    <thead>
                        <tr class="bg-black text-white">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Profile</th>
                            <th class="py-2 px-4 border-b">Em Name</th>
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
                        <?php
                        // Example data array
                        $employees = [
                            [
                                'id' => 1,
                                'profile_img' => 'profile-pic-url',  // Replace with actual image URL
                                'name' => 'Kris Wang',
                                'position' => 'Front-end',
                                'from' => '28.08.2024',
                                'to' => '30.08.2024',
                                'approver' => 'Mr. Cat',
                                'sub_approver' => 'XXXXXX',
                                'status' => 'Pending',
                            ],
                        ];

                        // Loop through each employee and generate table rows
                        foreach ($employees as $employee) {
                            echo '<tr class="hover:bg-white">';
                            echo '<td class="py-2 px-4 border-b">' . $employee['id'] . '</td>';
                            echo '<td class="py-2 px-4 border-b"><img src="' . $employee['profile_img'] . '" alt="Profile Image" class="w-10 h-10 rounded-full"></td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['name'] . '</td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['position'] . '</td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['from'] . ' / ' . $employee['to'] . '</td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['approver'] . '</td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['sub_approver'] . '</td>';
                            echo '<td class="py-2 px-4 border-b">' . $employee['status'] . '</td>';
                            echo '<td class="py-2 px-4 border-b"><a href="/admin/more" class="text-blue-500 hover:underline">More</a></td>';
                            echo '<td class="py-2 px-4 border-b"><select id="dropdown" class="w-full border h-10 d-flex border-gray-300 rounded px-3 py-2 mt-2">
                                    <option>Action</option>
                                    <option value="1">Panding</option>
                                    <option value="2">Accept</option>
                                    <option value="3">Reject</option> 
                                </select></td>';

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>