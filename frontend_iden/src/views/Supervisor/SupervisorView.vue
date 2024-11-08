<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0">
          <div class="container pb-20">
            <!----------- alert code -------------------->
            <div class="button" style="margin: 50px">
              <!-- Toast Alert Box -->
              <div class="button" style="margin: 50px">
                <div v-show="isToastVisible"
                  class="toast-box"
                  style=" position: absolute; top: 5%; right: 2%; display: flex; align-items: flex-end; flex-direction: column; overflow: hidden; padding: 2px; width: 23%;">
                  <div
                    role="alert"
                    class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                    {{ alertMessage }}
                  </div>
                </div>
              </div>
            </div>
            <!----------- //end alert code //-------------------->

            <div style=" border-bottom: #b0b0b0 1px solid; display: flex; justify-content: center; flex-direction: row; height: 30vh; width: 100%; ">
              <div style=" margin-bottom: 10px; border-right: #b0b0b0 1px solid; width: 55%; display: flex; justify-content: center; ">
                <div style=" margin-top: 30px; margin-left: 70px; width: 50%; height: 75%; display: flex; background: #f8c828; color: black; flex-direction: row;
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px; " >
                  <img src="../../assets/image/employees.png" style=" width: 100px; height: 50%; display: flex; align-self: center;"/>
                  <div class="ml-1">
                    <h4 class="font-bold mt-6"><b>Employees</b></h4>
                    <p>All :555</p>
                  </div>
                </div>
              </div>
              <div style="margin-bottom: 10px; width: 55%; display: flex; justify-content: center">
                <div style=" margin-top: 30px; margin-right: 70px; width: 50%; height: 75%; display: flex; flex-direction: row; background: #f8c828; color: black;
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px; ">
                  <img src="../../assets/image/Leave.png" style=" margin-left: 25px; width: 75px; height: 9vh; display: flex; align-self: center; "/>
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

              <div class="chart-container mb-10 rounded-2xl py-2 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="employeeChart"></canvas>
              </div>

              <div
                class="chart-container mb-10 h-60vh rounded-2xl px-10 py-5 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="leaveChart"></canvas>
              </div>
            </div>
            <!--.......................... member requestion leaves ......................... -->
            <div class="px-8 overflow-x-auto">
              <h1 class="text-4xl mb-4 text-black text-center">Member Requesting Leaves</h1>
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
                  <tr class="hover:bg-white text-xs" v-for="(request, index) in leaveRequests" :key="index">
                    <td class="py-2 px-2 text-center border-b">{{ request.id }}</td>
                    <td class="flex py-2 px-2 justify-center border-b">
                      <img src="../../assets/image/profile-avatar.jpg" alt="Profile Image" class="w-12 h-12 rounded-full object-cover" />
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ request.name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.position }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.date }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.approver }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.subApprover }}</td>
                    
                    <!-- Dropdown status update -->
                    <td class="py-2 px-2 text-center border-b">
                      
                      <div>
                        <span :class="statusClass(request.status)">{{ request.status }}</span>
                      </div>
                    </td>                    
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <a href="/supervisor/takeleave/view/leavedetail" class="text-blue-500 no-underline hover:text-blue-400">More</a>
                    </td>
                    <td class="action text-center align-middle">
                      <span
                        class="text-blue-500 hover:text-blue-400 font-semibold"
                        @click="toggleDropdown(index)">
                        View
                      </span>
                      <div v-if="dropdownVisible === index">
                        <select v-model="request.status" @change="updateStatus(index)">
                          <option value="Pending">Pending</option>
                          <option value="Approved">Approved</option>
                          <option value="Rejected">Rejected</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script setup lang="ts">
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'

import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'

// Function to create Employee Chart
const createEmployeeChart = () => {
  const ctx = document.getElementById('employeeChart').getContext('2d')
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['IT', 'Production', 'Finance', 'Creative'],
      datasets: [
        {
          backgroundColor: ['#b91d47', '#00aba9', '#2b5797', '#e8c3b9'],
          data: [24, 10, 2, 4]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Employees by Section',
          font: {
            size: 25 // Set the font size for the title
          }
        }
      }
    }
  })
}

// Function to create Leave Chart
const createLeaveChart = () => {
  const ctx = document.getElementById('leaveChart').getContext('2d')
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Creative', 'Content Creator', 'Production', 'IT'],
      datasets: [
        {
          label: 'Employees leaving',
          backgroundColor: 'rgba(151,187,205,0.5)',
          borderColor: 'rgba(151,187,205,1)',
          data: [1, 2, 4, 1]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1 // Step size placed inside ticks
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Employees Leaving by Department',
          font: {
            size: 25 // Set the font size for the title
          }
        }
      }
    }
  })
}

// Mount the charts once the component is mounted
onMounted(() => {
  createEmployeeChart()
  createLeaveChart()
})

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

// Sample data for leave requests
const leaveRequests = ref([
  { id: 1, name: 'John Doe', type: 'Sick Leave', position: 'Developer', date: '12.02.2024 | 12.03.2024', approver: 'Approver1', subApprover: 'Sub1', status: 'Pending' },
  { id: 2, name: 'Jane Doe', type: 'Annual Leave', position: 'Designer', date: '01.01.2024 | 01.02.2024', approver: 'Approver2', subApprover: 'Sub2', status: 'Approved' }
]);

const dropdownVisible = ref(null);

// Method to toggle the visibility of the dropdown
const toggleDropdown = (index) => {
  dropdownVisible.value = dropdownVisible.value === index ? null : index;
};

// Method to handle status update
const updateStatus = (index) => {
  const updatedStatus = leaveRequests.value[index].status;
  // Do something with the updated status, like sending it to a server or storing it
  console.log(`Leave request ${leaveRequests.value[index].id} updated to: ${updatedStatus}`);
};

// Method to dynamically assign classes based on status
const statusClass = (status) => {
  switch (status) {
    case 'Pending':
      return 'bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    case 'Approved':
      return 'bg-green-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    case 'Rejected':
      return 'bg-red-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    default:
      return '';
  }
};
</script>


<style scoped>
.supervisor {
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #e5e7eb;
}
.sidebar {
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main {
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #e5e7eb;
  margin-bottom: 50px;
}
</style>