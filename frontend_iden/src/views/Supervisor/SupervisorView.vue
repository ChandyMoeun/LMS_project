<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-5 px-10">
            <!----------- alert code -------------------->
            <div v-show="isToastVisible" class="toast-box button"
              style="margin: 50px; position: absolute; top: 5%; right: 2%; display: flex; align-items: flex-end; flex-direction: column; overflow: hidden; width: 17%;">
              <div role="alert" class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                {{ alertMessage }}
              </div>
            </div>
            <!----------- //end alert code //-------------------->
            <div class="d-flex justify-center flex-row h-[27vh]" style=" border-bottom: #b0b0b0 1px solid;">
              <div class="mb-2 d-flex justify-center ml-30" style="border-right: #b0b0b0 1px solid; width: 55%;">
                <div class="mt-4 w-70 h-35 d-flex text-black flex-row" style="background: #f8c828; 
                  box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px; " >
                  <img src="../../assets/image/employees.png" style=" width: 100px; height: 50%; display: flex; align-self: center;"/>
                  <div class="ml-1">
                    <h4 class="font-bold mt-6"><b>Employees</b></h4>
                    <p>All : </p>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-center mr-30" style="width: 55%;">
                <div class="mt-4 w-70 h-35 d-flex text-black flex-row" style="background: #f8c828; 
                  box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px; " >
                  <img src="../../assets/image/Leave.png" style=" margin-left: 14px; width: 70px; height: 40%; display: flex; align-self: center; "/>
                  <div>
                    <h4 class="font-bold mt-6 ml-5"><b>Leaveds</b></h4>
                    <p class="ml-5">This week : 555</p>
                  </div>
                </div>
              </div>
            </div>
            <!--............................// Chart js //..............................  -->
            <div class="chartjs mb-10 py-10 mt-10">
              <!-- Chart Container -->
              <h1 class="text-4xl text-black p-10 text-center">Employee Chart</h1>
              <div class="chart-container mb-10 rounded-2xl py-2 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="employeeChart"></canvas>
              </div>
              <div class="chart-container mb-10 h-60vh rounded-2xl px-10 py-5 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="leaveChart"></canvas>
              </div>
            </div>
            <!--.......................... member requestion leaves ......................... -->
            <h1 class="text-4xl mb-4 text-black text-center">Member Requesting Leaves</h1>
            <div class="shadow-[0px_4px_16px_rgba(17,17,26,0.1),_0px_8px_24px_rgba(17,17,26,0.1),_0px_16px_56px_rgba(17,17,26,0.1)] overflow-x-auto">
              <table class="min-w-full bg-white border border-gray-100">
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
                  <tr class="hover:bg-white text-xs"
                    v-for="leaveRequests in leaveRequestStore.leaveRequests" :key="leaveRequests.id">
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.staff_id }}</td>
                    <td class="flex py-2 px-2 justify-center border-b">
                      <img :src=" leaveRequests.profile && leaveRequests.profile
                            ? `http://127.0.0.1:8000/images/${leaveRequests.profile}`
                            : '/images/default-profile.jpg' "
                        alt="Profile Picture" class="w-12 h-12 rounded-full object-cover"/>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                      {{ leaveRequests.employee_name }}
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.leave_type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.position }}</td>
                    <td class="py-2 px-2 text-center border-b">
                      <span v-if="leaveRequests.start_time && leaveRequests.end_time"> 
                        {{ leaveRequests.start_time }} | {{ leaveRequests.end_time }}</span>
                      <span v-else >
                        {{ leaveRequests.from_date }} | {{ leaveRequests.to_date }}</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                      <span v-if="leaveRequests.approved_by">{{ leaveRequests.approved_by }}</span>
                      <span v-else>No approver</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">N/A</td>
                    <!-- Dropdown status update -->
                    <td class="py-2 px-2 text-center border-b">
                        <span :class="statusClass(leaveRequests.status)">{{ leaveRequests.status }}</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <a href="/supervisor/takeleave/view/leavedetail" class="text-blue-500 no-underline hover:text-blue-400">More</a>
                    </td>
                    <td class="action text-center align-middle">
                      <span class="text-blue-500 hover:text-blue-400 font-semibold" @click="toggleDropdown(leaveRequests.status)">
                        View
                      </span>
                      <div v-if="dropdownVisible === leaveRequests.status">
                        <select v-model="leaveRequests.status" @change="updateStatus(leaveRequests.status)">
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
import { useLeaveRequestStore } from '@/stores/request-leave'
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'
const leaveRequestStore = useLeaveRequestStore()
// Function to fetch leave requests (example for leaveRequestStore)
const fetchTeamLeaveRequests = async () => {
  try {
    await leaveRequestStore.fetchTeamLeaveRequests()
    console.log('Fetched leave requests:', leaveRequestStore.leaveRequests)
  } catch (error) {
    console.error('Error fetching leave requests:', error)
  }
}

// Fetch leave requests on component mount
onMounted(() => {
  fetchTeamLeaveRequests()
})

// Function to create Employee Chart
const createEmployeeChart = () => {
  const ctx = document.getElementById('employeeChart').getContext('2d')
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['IT', 'Production', 'Finance', 'Creative'],
      datasets: [ {
          backgroundColor: ['#b91d47', '#00aba9', '#2b5797', '#e8c3b9'],
          data: [24, 10, 2, 4]
      } ]
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
      datasets: [ {
          label: 'Employees leaving',
          backgroundColor: 'rgba(151,187,205,0.5)',
          borderColor: 'rgba(151,187,205,1)',
          data: [1, 2, 4, 1]
        } ]
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
onMounted(() => {
  createEmployeeChart()
  createLeaveChart()
})
const isToastVisible = ref(false)
const alertMessage = ref('Welcome To Dashboard! How are you?')
const showToast = () => {
  isToastVisible.value = true
  setTimeout(() => {
    isToastVisible.value = false
  }, 4000) 
}
onMounted(() => {
  showToast()
})

// Sample data for leave requests
const dropdownVisible = ref(null)

// Method to toggle the visibility of the dropdown
const toggleDropdown = (index) => {
  dropdownVisible.value = dropdownVisible.value === index ? null : index
}

// Method to handle status update
const updateStatus = (index) => {
  const updatedStatus = leaveRequests.value[index].status
  // Do something with the updated status, like sending it to a server or storing it
  console.log(`Leave request ${leaveRequests.value[index].id} updated to: ${updatedStatus}`)
}

// Method to dynamically assign classes based on status
const statusClass = (status) => {
  switch (status) {
    case 'Pending':
      return 'bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-semibold'
    case 'Approved':
      return 'bg-green-400 text-white px-2 py-1 rounded-full text-xs font-semibold'
    case 'Rejected':
      return 'bg-red-400 text-white px-2 py-1 rounded-full text-xs font-semibold'
    default:
      return ''
  }
}
</script>