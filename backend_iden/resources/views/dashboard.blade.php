<x-app-layout>
    <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mb-20">
            <div class="container mx-auto px-6 py-8">


                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                        @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </b> </p>

            </div>
        </main>
    </div>
    <div class="Container d-flex justify-content-center" style="  width:100%">
        <div class="ml-5" style="display: flex; justify-content:center; flex-direction: row; height:25vh;">
            <div style=" width: 40%; box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px; display: flex; justify-content:center;">
                <div class=" bg-yellow-400 mb-5" style=" width: 50%; display: flex; flex-direction: row;">
                    <img src="../images/employees.png" style="width: 100px; height:50%; display: flex; align-self:center;">
                    <div>
                        <h1 class="font-bold mt-6 text-2xl"><b>Employees</b></h1>
                        <h3><b>All : </b></h3>
                    </div>
                </div>
            </div>
            <div style=" width: 40%; box-shadow: rgb(0, 0, 0, 0.15) -3px 2.4px 2.4px 0px; display: flex; justify-content:center;">
                <div class=" bg-yellow-400 mb-5" style=" width: 50%; display: flex; flex-direction: row;">
                    <img src="../images/Leave.png" style="margin-left: 25px; width: 75px; height:9vh; display: flex; align-self:center;">
                    <div>
                        <h1 class="font-bold mt-6 text-2xl "><b>Leaveds</b></h1>
                        <h3><b>This Week : </b></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart js for table of employees -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chart Centered</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <style>
            /* Center the chart on the page */
            .chart-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                /* Make the container full height */
            }
        </style>
    </head>

    <body>

        <!-- Chart Container -->
        <div class="chart-container">
            <canvas id="employeeChart" style="width:100%;max-width:800px" class="mt-20"></canvas>
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
                type: "pie",
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
    </body>
    </html>
</x-app-layout>