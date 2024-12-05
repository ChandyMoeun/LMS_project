<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-5 pb-20 px-10">
            <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <h1 class="font-bold mr-20 text-3xl px-8 w-3/12 mt-3 hover:text-yellow-400">
                <b>Request Leave</b>
              </h1>
            </div>
            <div class="flex justify-end items-end mt-16 mb-3">
              <a href="/employee/myleave/historyleave"
                class="mr-10 px-3 py-1 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline"
                >My History</a>
            </div>
            <div class="container mt-2 px-6 py-4 bg-white shadow-md rounded-lg">
              <form @submit.prevent="handleSubmit"
                enctype="multipart/form-data" class="flex flex-row justify-between p-3 gap-5">
                <div class="w-6/12">
                  <div class="mt-3">
                    <label for="leaveType_id" class="block text-sm font-medium text-gray-700">Leave Type:</label>
                    <select id="leaveType_id" v-model="leaveRequest.leaveType_id" required class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm">
                      <option value="" disabled>Select a leave type</option>
                      <option v-for="leaveType in leaveTypeStore.leaveTypes" :key="leaveType.id" :value="leaveType.id"> {{ leaveType.leave_name }} </option>
                    </select>
                  </div>
                  <div>
                    <!-- Leave Duration (Full Day, Half Day, Specific Time) -->
                    <div class="mt-3">
                      <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Duration</label>
                      <select v-model="duration" id="leave_type" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm">
                        <option value="full_day">Full Day</option>
                        <option value="half_day">Half Day</option>
                        <option value="time">Specific Time</option>
                      </select>
                    </div>

                    <!-- Half Day Type (Morning, Afternoon) -->
                    <div v-if="duration === 'half_day'" class="mt-3">
                      <label class="block text-sm font-medium text-gray-700"> Select Half Day Type </label>
                      <div class="mt-2">
                        <label class="inline-flex items-center">
                          <input type="radio" name="half_day_type" value="morning" v-model="leaveRequest.half_day_type" class="form-radio text-blue-600"/>
                          <span class="ml-2">Morning</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                          <input type="radio" name="half_day_type" value="afternoon" v-model="leaveRequest.half_day_type" class="form-radio text-blue-600" />
                          <span class="ml-2">Afternoon</span>
                        </label>
                      </div>
                    </div>
                    <!-- From Date/Time -->
                    <div v-if="duration === 'full_day'" class="mt-3">
                      <label for="from_date" class="block text-sm font-medium text-gray-700">From Date </label>
                      <input type="date" id="from_date" v-model="leaveRequest.from_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>

                    <!-- To Date -->
                    <div v-if="duration === 'full_day'" class="mt-3">
                      <label for="to_date" class="block text-sm font-medium text-gray-700"> To Date </label>
                      <input type="date" id="to_date" v-model="leaveRequest.to_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>

                    <!-- Specific Time -->
                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="start_time" class="block text-sm font-medium text-gray-700"> Start Time </label>
                      <input type="time" id="start_time" v-model="leaveRequest.start_time"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>

                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="end_time" class="block text-sm font-medium text-gray-700"> End Time </label>
                      <input type="time" id="end_time" v-model="leaveRequest.end_time"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>

                    <!-- select time show from_date -->
                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="from_date" class="block text-sm font-medium text-gray-700"> From Date </label>
                      <input type="date" id="from_date" v-model="leaveRequest.from_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>

                    <!-- select time show to_date -->
                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="to_date" class="block text-sm font-medium text-gray-700"> To Date </label>
                      <input type="date" id="to_date" v-model="leaveRequest.to_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"/>
                    </div>
                    <!-- select half day show from_date -->
                    <div v-if="duration === 'half_day'" class="mt-3">
                      <label for="from_date" class="block text-sm font-medium text-gray-700"> From Date </label>
                      <input type="date" id="from_date" v-model="leaveRequest.from_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" />
                    </div>

                    <!-- select half day show to_date -->
                    <div v-if="duration === 'half_day'" class="mt-3">
                      <label for="to_date" class="block text-sm font-medium text-gray-700"> To Date </label>
                      <input type="date" id="to_date" v-model="leaveRequest.to_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" />
                    </div>
                  </div>
                </div>
                <div class="w-6/12">
                  <div>
                    <label for="reason">Reason:</label>
                    <textarea id="reason" v-model="leaveRequest.reason" placeholder="Reason for leave" required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"></textarea>
                  </div>

                  <div class="flex flex-col items-center justify-center w-full mt-3">
                    <label for="dropzone-file"
                      class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                      <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                          <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          SVG, PNG, JPG, or GIF (MAX. 800x400px)
                        </p>
                      </div>
                      <input id="dropzone-file" type="file" class="hidden" multiple @change="handleFileUpload" />
                    </label>

                    <!-- Display Selected Files -->
                    <ul class="mt-4 w-full space-y-2">
                      <li v-for="(file, index) in selectedFiles" :key="index"
                        class="p-2 text-sm text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                        {{ file.name }} - {{ formatFileSize(file.size) }}
                      </li>
                    </ul>
                  </div>

                  <button type="submit"
                    class="mt-6 bg-gray-900 text-white font-semibold px-2 py-1 mr-3 rounded-lg shadow-md hover:bg-yellow-400 transition-colors border-none">
                    Request Leave
                  </button>
                </div>
              </form>
            </div>
            <div class="px-8 overflow-x-auto">
              <h1 class="text-4xl p-10 text-black text-center">My Requesting Leaves</h1>
              <table class="min-w-full bg-gray-100 border border-gray-100">
                <thead>
                  <tr class="bg-black text-white text-xs">
                    <th class="py-2 px-2 text-center border-b">ID</th>
                    <th class="py-2 px-2 text-center border-b">Name</th>
                    <th class="py-2 px-2 text-center border-b">Type</th>
                    <th class="py-2 px-2 text-center border-b">From | To</th>
                    <th class="py-2 px-2 text-center border-b">Half Day</th>
                    <th class="py-2 px-2 text-center border-b">Approver</th>
                    <th class="py-2 px-2 text-center border-b">Sub-approver</th>
                    <th class="py-2 px-2 text-center border-b">Status</th>
                    <th class="py-2 px-2 text-center border-b">Detail</th>
                  </tr>
                </thead>
                <tbody v-for="requests in leaveRequestStore.leaveRequests" :key="requests.id">
                  <tr v-if="requests.employee_id === user.id" class="hover:bg-white text-xs">
                    <td class="py-2 px-2 text-center border-b">
                      {{ requests.staff_id }}
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ requests.employee_name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ requests.leave_type }}</td>
                    <td class="py-2 px-2 text-center border-b">
                      <!-- Display start and end time if both are available -->
                      <span v-if="requests.start_time && requests.end_time">
                        {{ requests.start_time }} | {{ requests.end_time }}
                      </span>
                      <!-- Display half day type if it's either 'morning' or 'afternoon' -->
                      <span
                        v-else-if="
                          requests.half_day_type === 'morning' ||
                          requests.half_day_type === 'afternoon' " >
                        half_day
                      </span>
                      <!-- Fallback: Display from and to dates -->
                      <span v-else> {{ requests.from_date }} | {{ requests.to_date }} </span>
                    </td>

                    <td class="py-4 px-2 text-sm text-center text-black">
                      <span v-if="requests.start_time && requests.end_time">time</span>
                      <span v-else>{{ requests.half_day_type }}</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                      <span v-if="requests.approved_by">{{ requests.approved_by }}</span>
                      <span v-else-if="requests.rejected_by">{{ requests.rejected_by }}</span>
                      <span v-else>No approver</span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">N/A</td>
                    <td class="py-2 px-2 text-center border-b">
                      <div>
                        <span
                          :class="{
                            'bg-yellow-400 text-black': requests.status === 'pending',
                            'bg-green-500 text-white': requests.status === 'approved',
                            'bg-red-500 text-white': requests.status === 'rejected'
                          }"
                          class="text-center px-2 py-1 rounded-full text-xs font-semibold">
                          {{ requests.status }}
                        </span>
                      </div>
                    </td>
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <router-link
                        :to="{ name: 'leaveDetail', params: { id: requests.id } }"
                        class="text-blue-700 no-underline hover:text-blue-300"> View
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

<script setup>
import { ref, computed, onMounted } from 'vue'
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
import { useLeaveTypeStore } from '@/stores/leave-type' // Import the store
import { userAuthStore } from '@/stores/get-me' // Import the Auth store

// ===get user to compar Auth
const authStore = userAuthStore()
const user = authStore.user
const leaveRequestStore = useLeaveRequestStore()
const leaveTypeStore = useLeaveTypeStore()
const duration = ref('full_day') // Selected leave type (default: Full Day)
const requestStatus = ref(null) // Status of the leave request
const addSeconds = (time) => (time ? `${time}:00` : '')

const leaveRequest = ref({
  // employee_id: null,
  leaveType_id: '',
  half_day_type: 'full_day', // Default to full day
  start_time: '',
  end_time: '',
  total_requested_days: '',
  status: 'pending', // Default to pending
  from_date: '',
  to_date: '',
  reason: '',
  attachment: null // Placeholder for future attachment handling if needed
})

// Handle form submission
const handleSubmit = async () => {
  // Format start_time and end_time with seconds
  leaveRequest.value.start_time = addSeconds(leaveRequest.value.start_time)
  leaveRequest.value.end_time = addSeconds(leaveRequest.value.end_time)

  // Validate date range
  if (new Date(leaveRequest.value.to_date) < new Date(leaveRequest.value.from_date)) {
    alert("The 'To Date' must be after or equal to the 'From Date'.")
    requestStatus.value = 'error'
    return
  }

  try {
    await leaveRequestStore.submitLeaveRequest(leaveRequest.value)
    requestStatus.value = leaveRequestStore.requestStatus // Update local status
    window.location.reload()
  } catch (error) {
    requestStatus.value = 'error' // Handle error
    console.error('Error submitting leave request:', error)
  }
}

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

// Reactive array to hold selected files
const selectedFiles = ref([])

// Handle file input change event
function handleFileUpload(event) {
  const files = Array.from(event.target.files)
  selectedFiles.value = files
}

// Format file size to a readable format
function formatFileSize(size) {
  if (size < 1024) return `${size} B`
  if (size < 1024 * 1024) return `${(size / 1024).toFixed(2)} KB`
  return `${(size / (1024 * 1024)).toFixed(2)} MB`
}
</script>