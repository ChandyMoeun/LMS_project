<x-app-layout>

    <div class="mt-20">

        <div class="container mx-auto px-6 py-8">
            <!-- <div class="button" style="margin: 50px;">
                <button onclick="ShowAlert(alertMsg)" style="background-color: #333; color:#fff; border:0; outline:0; width:120px; height:40px; margin:9px; cursor:pointer; ">alert</button>
                <div id="taostBox" style="position: absolute; top:10%; right:2%; display:flex; align-items:flex-end; flex-direction:column; overflow:hidden; padding:20px"></div>
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
                let alertMsg = 'Welcom To Addmin Dashboard. How are you?'

                function ShowAlert(msg) {
                    let taost = document.createElement('div');
                    taost.classList.add('taost');
                    taost.innerHTML = msg;
                    taostBox.appendChild(taost);

                    if (msg.includes('alert')){
                        taost.classList.add('alert');
                    }
                    setTimeout(() => {
                        taostBox.removeChild(taost);
                    }, 4000);
                }
            </script> -->


            <div class="Container p-2 d-flex justify-content-center" style="  width:100%">
                <div style="border-bottom: #B0B0B0 1px solid;  display: flex; justify-content:center; flex-direction: row; height:30vh; width: 90%; margin-top: 35px;">
                    <div style="margin-bottom: 10px; border-right: #B0B0B0 1px solid; width: 45%;  display: flex; justify-content:center;">
                        <div class=" bg-yellow-400" style="margin-top: 30px; margin-left: 70px; width: 50%; height:65%; display: flex; flex-direction: row; box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
                            <img src="../images/employees.png" style="width: 100px; height:50%; display: flex; align-self:center;">
                            <div class="ml-1">
                                <h5 class="font-bold mt-6 "><b>Employees</b></h5>
                                <p>All :</p>
                            </div>
                        </div>
                    </div>
                    <div style=" width: 45%; display: flex; justify-content:center;">
                        <div class=" bg-yellow-400 " style="margin-top: 30px; margin-right: 70px; width: 50%; height:65%; display: flex; flex-direction: row; box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
                            <img src="../images/Leave.png" style="margin-left: 25px; width: 75px; height:9vh; display: flex; align-self:center;">
                            <div>
                                <h5 class="font-bold mt-6 ml-3 "><b>Leaveds</b></h5>

                                <p class="ml-1"><em>This week : </em></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--............................ Chart js..............................  -->

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <style>
                /* Center the chart on the page */
                .chart-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top: 55px;
                    margin-bottom: 90px;
                }

                canvas {
                    max-width: 89%;
                    background: white;
                    width: 100%;
                    box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
                    padding: 15px;
                    border-radius: 10px;
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

            <!--.......................... employees list of leave......................... -->

            <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            </head>

            <body>

                <div class="container mt-5">
                    <div class="section-header">
                        <h2><b>THIS WEEK </b></h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    <th>Em Name</th>
                                    <th>Position</th>
                                    <th>From | To </th>
                                    <th>Approver</th>
                                    <th>Sub-approver</th>
                                    <th>Status</th>
                                    <th>Detail</th>
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
                                        'status' => 'Pending'
                                    ],
                                    // Add more employees as needed...
                                ];

                                // Loop through each employee and generate table rows
                                foreach ($employees as $employee) {
                                    echo '<tr>';
                                    echo '<td>' . $employee['id'] . '</td>';
                                    echo '<td><img src="' . $employee['profile_img'] . '" alt="Profile Image" class="profile-img"></td>';
                                    echo '<td>' . $employee['name'] . '</td>';
                                    echo '<td>' . $employee['position'] . '</td>';
                                    echo '<td>' . $employee['from'] . ' / ' . $employee['to'] . '</td>';
                                    echo '<td>' . $employee['approver'] . '</td>';
                                    echo '<td>' . $employee['sub_approver'] . '</td>';
                                    echo '<td>' . $employee['status'] . '</td>';
                                    echo '<td><a href="#" class="text-primary">More</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </body>
        </div>
    </div>


</x-app-layout>