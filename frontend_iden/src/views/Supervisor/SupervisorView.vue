<template>
  <div class="container">
      <!----------- alert code -------------------->
      <div class="button" style="margin: 50px">
        <!-- Toast Alert Box -->
        <div class="button" style="margin: 50px">
          <div
            v-show="isToastVisible"
            class="toast-box"
            style="
              position: absolute;
              top: 5%;
              right: 2%;
              display: flex;
              align-items: flex-end;
              flex-direction: column;
              overflow: hidden;
              padding: 2px;
              width: 23%;
            "
          >
            <div role="alert" class="mb-4 relative flex w-full p-3 pr-5  text-sm text-white bg-black rounded-md items-center">
              {{ alertMessage }}
            </div>
          </div>
        </div>
      </div>
      <!----------- //end alert code //-------------------->

      <div
        style="
          border-bottom: #b0b0b0 1px solid;
          display: flex;
          justify-content: center;
          flex-direction: row;
          height: 30vh;
          width: 100%;
        "
      >
        <div
          style="
            margin-bottom: 10px;
            border-right: #b0b0b0 1px solid;
            width: 55%;
            display: flex;
            justify-content: center;
          "
        >
          <div
            style="
              margin-top: 30px;
              margin-left: 70px;
              width: 50%;
              height: 75%;
              display: flex;
              background: #F8C828;
              color: black;
              flex-direction: row;
              box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
                rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
            "
          >
            <img
              src="../../assets/image/profile-avatar.jpg"
              style="margin-left: 8px; width: 100px; height: 50%; display: flex; align-self: center"
            />
            <div class="ml-1">
              <h4 class="font-bold mt-6"><b>Employees</b></h4>
              <p>All :555</p>
            </div>
          </div>
        </div>
        <div style="margin-bottom: 10px; width: 55%; display: flex; justify-content: center">
          <div
            style="
              margin-top: 30px;
              margin-right: 70px;
              width: 50%;
              height: 75%;
              display: flex;
              flex-direction: row;
              background: #F8C828;
              color: black;
              box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
                rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
            "
          >
            <img
              src="../../assets/image/profile-avatar.jpg"
              style="margin-left: 25px; width: 75px; height: 9vh; display: flex; align-self: center"
            />
            <div>
              <h4 class="font-bold mt-6 ml-3"><b>Leaveds</b></h4>

              <p class="ml-1"><em>This week : 555</em></p>
            </div>
          </div>
        </div>
      </div>

      <!--............................// Chart js // total employee chart ..............................  -->
      <div class="chartjs mb-10 py-10">
        <!-- Chart Container -->
        <h1 class="text-4xl text-black p-10 text-center">Employee Chart</h1>

        <div class="chart-container mb-10 rounded-2xl py-5 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
          <canvas id="employeeChart"></canvas>
        </div>

        <div class="chart-container mb-10 rounded-2xl px-10 py-5 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
          <canvas id="leaveChart"></canvas>
        </div>
      </div>
      <!--.......................... employees take leaves ......................... -->
      <div class="overflow-x-auto">
        <h1 class="text-4xl p-10 text-black text-center">Leave Requests</h1>
        <table class="min-w-full bg-gray-100 border border-gray-100">
          <thead>
            <tr class="bg-black text-white text-xs">
              <th class="py-2 px-2 text-center border-b">ID</th>
              <th class="py-2 px-2 text-center border-b">Profile</th>
              <th class="py-2 px-2 text-center border-b">Name</th>
              <th class="py-2 px-2 text-center border-b">Type</th>
              <th class="py-2 px-2 text-center border-b">Position</th>
              <th class="py-2 px-2 text-center border-b">From | To</th>
              <th class="py-2 px-2 text-center border-b">Approver</th>
              <th class="py-2 px-2 text-center border-b">Sub-approver</th>
              <th class="py-2 px-2 text-center border-b">Status</th>
              <th class="py-2 px-2 text-center border-b">Detail</th>
              <th class="py-2 px-2 text-center border-b">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through each employee and generate table rows -->
            <tr class="hover:bg-white text-xs">
              <td class="py-2 px-2 text-center border-b">user ID</td>
              <td class="flex py-2 px-2 justify-center border-b">
                <img
                  src="../../assets/image/profile-avatar.jpg"
                  alt="Profile Image"
                  class="w-12 h-12 rounded-full object-cover"
                />
              </td>
              <td class="py-2 px-2 text-center border-b">user full name</td>
              <td class="py-2 px-2 text-center border-b">sick leave</td>
              <td class="py-2 px-2 text-center border-b">position</td>
              <td class="py-2 px-2 text-center border-b">12,02.2024|12,03.2024</td>
              <td class="py-2 px-2 text-center border-b">Approver</td>
              <td class="py-2 px-2 text-center border-b text-xs">XXX</td>
              <td class="py-2 px-2 text-center border-b text-xs">
                Status
                <span class="bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-semibold"
                  >Pending</span
                >
                <span class="bg-green-400 text-white px-2 py-1 rounded-full text-xs font-semibold"
                  >Approved</span
                >
                <span class="bg-red-400 text-white px-2 py-1 rounded-full text-xs font-semibold"
                  >Rejected</span
                >
              </td>
              <td class="py-2 px-2 text-center border-b text-xs">
                <a href="#" class="text-blue-500 hover:text-blue-400">More</a>
              </td>
              <td class="action text-center align-middle">
                <!-- View button to toggle the visibility -->
                <button
                  type="button"
                  class="text-blue-500 hover:text-blue-400 font-semibold px-2 py-1 rounded-md"
                  onclick="toggleButtons({{ $leaveRequest->id }})"
                >
                  Views
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script setup lang="ts">
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto';

// Function to create Employee Chart
const createEmployeeChart = () => {
  const ctx = document.getElementById('employeeChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['IT', 'Production', 'Finance', 'Creative'],
      datasets: [{
        backgroundColor: ['#b91d47', '#00aba9', '#2b5797', '#e8c3b9'],
        data: [24, 10, 2, 4],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Employees by Section',
          font: {
            size: 25, // Set the font size for the title
          }
        }
      }
    }
  });
};

// Function to create Leave Chart
const createLeaveChart = () => {
  const ctx = document.getElementById('leaveChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Creative', 'Content Creator', 'Production', 'IT'],
      datasets: [{
        label: 'Employees leaving',
        backgroundColor: 'rgba(151,187,205,0.5)',
        borderColor: 'rgba(151,187,205,1)',
        data: [1, 2, 4, 1],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1, // Step size placed inside ticks
          },
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Employees Leaving by Department',
          font: {
            size: 25, // Set the font size for the title
          }
        }
      }
    }
  });
};

// Mount the charts once the component is mounted
onMounted(() => {
  createEmployeeChart();
  createLeaveChart();
});

// Reactive state for toast visibility and message
const isToastVisible = ref(false)
const alertMessage = ref('Welcome To Dashboard! How are you?')

// Function to show the alert
const showToast = () => {
  isToastVisible.value = true
  setTimeout(() => {
    isToastVisible.value = false
  }, 4000) // Hide after 4 seconds
}

// Automatically show the alert on component mount
onMounted(() => {
  showToast()
})
</script>

<style scoped>
/* Styling for the chart container */
.chart-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 90px;
  height: 60vh;
};

</style>