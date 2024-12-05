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
                  <div
                    role="alert"
                    class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center"
                  >
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
                    background: #f8c828;
                    color: black;
                    flex-direction: row;
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
                      rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
                  "
                >
                  <img
                    src="../../assets/image/employees.png"
                    style="width: 100px; height: 50%; display: flex; align-self: center"
                  />
                  <div class="ml-1">
                    <h4 class="font-bold mt-6"><b>Employees</b></h4>
                    <p>All :{{ teamStore.teamCount }}</p>
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
                    background: #f8c828;
                    color: black;
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px,
                      rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
                  "
                >
                  <img
                    src="../../assets/image/Leave.png"
                    style="
                      margin-left: 25px;
                      width: 75px;
                      height: 9vh;
                      display: flex;
                      align-self: center;
                    "
                  />
                  <div>
                    <h4 class="font-bold mt-6 ml-3"><b>Leaveds</b></h4>
                    <p class="ml-1">
                      <em>This week : {{ leaveRequestCountThisWeek }}</em>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!--............................// Chart js // total employee chart ..............................  -->
            <div class="chartjs mb-10 py-10">
              <!-- Chart Container -->
              <h1 class="text-4xl text-black p-10 text-center">Employee Chart</h1>

              <div
                class="chart-container mb-10 rounded-2xl py-2 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]"
              >
                <canvas id="employeeChart"></canvas>
              </div>

              <div
                class="chart-container mb-10 h-60vh rounded-2xl px-10 py-5 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]"
              >
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
                    <th class="py-2 px-2 text-center border-b">Status</th>
                    <th class="py-2 px-2 text-center border-b">Detail</th>
                    <th class="py-2 px-2 text-center border-b">Action</th>
                  </tr>
                </thead>
                <tbody
                  v-for="leaveRequests in leaveRequestStore.leaveRequests"
                  :key="leaveRequests.id"
                >
                  <tr class="hover:bg-white text-xs">
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.staff_id }}</td>
                    <td class="flex py-2 px-2 justify-center border-b">
                      <img
                        :src="
                          leaveRequests.profile && leaveRequests.profile
                            ? `http://127.0.0.1:8000/images/${leaveRequests.profile}`
                            : '/images/default-profile.jpg'
                        "
                        alt="Profile Picture"
                        class="w-12 h-12 rounded-full object-cover"
                      />
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                      {{ leaveRequests.employee_name }}
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.leave_type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ leaveRequests.position }}</td>
                    <td class="py-2 px-2 text-center border-b">
                      <!-- Display start and end time if both are available -->
                      <span v-if="leaveRequests.start_time && leaveRequests.end_time">
                        {{ leaveRequests.start_time }} | {{ leaveRequests.end_time }}
                      </span>

                      <!-- Display half day type if it's either 'morning' or 'afternoon' -->
                      <span
                        v-else-if="
                          leaveRequests.half_day_type === 'morning' ||
                          leaveRequests.half_day_type === 'afternoon'
                        "
                      >
                        half_day
                      </span>

                      <!-- Fallback: Display from and to dates -->
                      <span v-else>
                        {{ leaveRequests.from_date }} | {{ leaveRequests.to_date }}
                      </span>
                    </td>

                    <td class="py-2 px-2 text-center border-b">
                      <span v-if="leaveRequests.approved_by">{{ leaveRequests.approved_by }}</span>
                      <span v-else>No approver</span>
                    </td>
                    <!-- Dropdown status update -->
                    <td class="py-2 px-2 text-center border-b">
                      <div>
                        <span
                          :class="{
                            'bg-yellow-400 text-black': leaveRequests.status === 'pending',
                            'bg-green-500 text-white': leaveRequests.status === 'approved',
                            'bg-red-500 text-white': leaveRequests.status === 'rejected'
                          }"
                          class="text-center px-3 py-2 rounded-full text-xs font-semibold"
                        >
                          {{ leaveRequests.status }}
                        </span>
                      </div>
                    </td>
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <router-link
                        :to="{ name: 'viewLeaveDetail', params: { id: leaveRequests.id } }"
                        class="text-blue-700 no-underline hover:text-blue-300"
                      >
                        View
                      </router-link>
                    </td>
                    <td class="text-sm px-2 font-medium text-center">
                      <div class="flex justify-center mt-2 space-x-2">
                        <button
                          class="bg-gray-900 text-white px-2 py-1 rounded-md shadow-md hover:bg-yellow-500 transition-all duration-300 ease-in-out font-semibold border-none"
                          :disabled="
                            leaveRequests.status === 'approved' ||
                            leaveRequests.status === 'rejected'
                          "
                          :class="{
                            'opacity-50 cursor-not-allowed':
                              leaveRequests.status === 'approved' ||
                              leaveRequests.status === 'rejected'
                          }"
                          @click="approveRequest(leaveRequests.id)"
                        >
                          Approve
                        </button>
                        <button
                          class="bg-red-500 text-white px-2 py-1 rounded-md shadow-md hover:bg-red-400 transition-all duration-300 ease-in-out font-semibold border-none"
                          :disabled="
                            leaveRequests.status === 'approved' ||
                            leaveRequests.status === 'rejected'
                          "
                          :class="{
                            'opacity-50 cursor-not-allowed':
                              leaveRequests.status === 'approved' ||
                              leaveRequests.status === 'rejected'
                          }"
                          @click="rejectRequest(leaveRequests.id, 'Not enough leave balance')"
                        >
                          Reject
                        </button>
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
import { useTeamStore } from '@/stores/get-member'

const teamStore = useTeamStore()
const leaveRequestStore = useLeaveRequestStore()

// Declare reactive state variables with proper types
const leaveRequestCountThisWeek = ref(0) // leaveRequestCountThisWeek is a number
const requestStatus = ref<'success' | 'error' | null>(null) // requestStatus can be 'success', 'error', or null
// Fetch team leave requests when the component is mounted
onMounted(async () => {
  await leaveRequestStore.fetchTeamLeaveRequests()
  // After fetching, sync the count and status to the reactive variables
  leaveRequestCountThisWeek.value = leaveRequestStore.leaveRequestCountThisWeek
  requestStatus.value = leaveRequestStore.requestStatus
})

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

const approveRequest = async (id: any) => {
  try {
    await leaveRequestStore.approveLeaveRequest(id) // Call the approve action from Pinia store
    window.location.reload()
  } catch (error) {
    console.error('Error approving leave request:', error)
  }
}

const rejectRequest = async (id: any) => {
  try {
    await leaveRequestStore.rejectLeaveRequest(id) // Call the reject action from Pinia store
    window.location.reload()
  } catch (error) {
    console.error('Error rejecting leave request:', error)
  }
}

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

onMounted(async () => {
  await teamStore.fetchTeamMembers() // Fetch employee data as well
})
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