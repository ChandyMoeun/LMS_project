<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="px-10 container pb-30">
                <!-- Header -->
            <div class="mt-5  text-black" style="border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-400 w-4/12">Employee Dashboard</h1>
            </div>
            <!----------- alert code -------------------->
            <div v-show="isToastVisible" class="toast-box mt-5"
              style=" position: absolute; top: 7%; right: 2%; display: flex; align-items: flex-end; flex-direction: column; overflow: hidden; padding: 2px; width: 17%;">
              <div role="alert" class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                {{ alertMessage }}
              </div>
            </div>
            <!----------- //end alert code //--------------------> 
            <!--............................// Chart js // total employee leave balance chart ..............................  -->
            <!-- Chart Container -->
            <h1 class="text-4xl text-black p-10 text-center">My Leave Balance</h1>
            <div
              class="chart-container flex justify-center mb-10 rounded-2xl py-3 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]"
            >
              <canvas id="myLeaveBalance" style="width: 100%; max-width: 800px; height: 100vh; max-height: 70vh" ></canvas>
            </div>
            <!--............................list of my requesting leaves ..............................  -->
            <div class="px-8 overflow-x-auto">
              <h1 class="text-4xl p-10 text-black text-center">My Requesting Leaves</h1>
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
                  </tr>
                </thead>
                <tbody v-for="request in leaveRequestStore.leaveRequests" :key="request.id">
                  <tr v-if="request.employee_id === user.id" class="hover:bg-white text-xs">
                    <td class="py-2 px-2 text-center border-b">{{ request.staff_id }}</td>
                    <td class="flex py-2 px-2 justify-center border-b">
                      <img
                        :src="
                          request.profile && request.profile
                            ? `http://127.0.0.1:8000/images/${request.profile}`
                            : '/images/default-profile.jpg' "
                        class="w-12 h-12 rounded-full object-cover"/>
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ request.employee_name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.leave_type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.position }}</td>
                    <td class="py-2 px-2 text-center border-b">
                      <!-- Display start and end time if both are available -->
                      <span v-if="request.start_time && request.end_time">
                        {{ request.start_time }} | {{ request.end_time }}
                      </span>
                      <!-- Display half day type if it's either 'morning' or 'afternoon' -->
                      <span
                        v-else-if="
                          request.half_day_type === 'morning' ||
                          request.half_day_type === 'afternoon'
                        "> half_day
                      </span>
                      <!-- Fallback: Display from and to dates -->
                      <span v-else> {{ request.from_date }} | {{ request.to_date }} </span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                      <span v-if="request.approved_by">{{ request.approved_by }}</span>
                      <span v-else-if="request.rejected_by">{{ request.rejected_by }}</span>
                      <span v-else>No approver</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">N/A</td>
                    <td class="py-2 px-2 text-center border-b">
                      <div>
                        <span
                          :class="{
                            'bg-yellow-400 text-black': request.status === 'pending',
                            'bg-green-500 text-white': request.status === 'approved',
                            'bg-red-500 text-white': request.status === 'rejected'
                          }"
                          class="text-center px-2 py-1 rounded-full text-xs font-semibold">
                          {{ request.status }}
                        </span>
                      </div>
                    </td>
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <router-link
                        :to="{ name: 'leaveDetail', params: { id: request.id } }"
                        class="text-blue-700 no-underline hover:text-blue-300"
                      > View
                      </router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import EmployeeLayout from '@/Components/Layouts/EmployeeLayout.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
import { useLeaveTypeStore } from '@/stores/leave-type' // Import the store
import { userAuthStore } from '@/stores/get-me' // Import the Auth store
import Chart from 'chart.js/auto'

// ===get user to compar Auth
const authStore = userAuthStore()
const user = authStore.user
console.log(user)
const leaveRequestStore = useLeaveRequestStore()
const leaveTypeStore = useLeaveTypeStore()
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
  leaveTypeStore.fetchLeaveTypes()
  console.log('Fetched leave requests:', leaveTypeStore.leaveRequests)
})

// Fetch leave types on mount
onMounted(async () => {
  await leaveTypeStore.fetchLeaveTypes()
})

// Function to create Employee Chart
const employeeLeaveBalance = () => {
  var xValues = ['AL', 'Special', 'ML', 'Sick Leave', 'UPL']
  var yValues = [18, 7, 7, 30, 30]
  var barColors = ['#b91d47', '#00aba9', '#2b5797', '#e8c3b9', '#1e7145']

  new Chart('myLeaveBalance', {
    type: 'pie',
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: barColors,
          data: yValues
        }
      ]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'My Leave Balance Chart'
        }
      }
    }
  })
}

// Mount the charts once the component is mounted
onMounted(() => {
  employeeLeaveBalance()
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