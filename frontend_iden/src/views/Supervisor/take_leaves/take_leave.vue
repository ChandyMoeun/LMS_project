<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0">
          <div class="mt-10">
            <!-- Admin Requests leave -->
            <div
              class="d-flex text-black"
              style="display: flex; flex-direction: column; border-bottom: solid 1px gray"
            >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-3/12">
                <b>Request Leave</b>
              </h1>
            </div>
            <div class="mt-10 px-6 py-4 bg-white shadow-md rounded-lg">
              <form
                @submit.prevent="handleSubmit"
                enctype="multipart/form-data"
                class="flex flex-row justify-between p-3 gap-5"
              >
                <div class="w-6/12">
                  <!-- <div class="mt-3">
                    <label for="employee_id">Employee ID:</label>
                    <input
                      id="employee_id"
                      v-model="leaveRequest.employee_id"
                      type="number"
                      placeholder="Employee ID"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div> -->
                  <!-- <div class="mt-3">
                    <label for="leaveType_id">Leave Type ID:</label>
                    <input
                      id="leaveType_id"
                      v-model="leaveRequest.leaveType_id"
                      type="number"
                      placeholder="Leave Type ID"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div> -->
                  <div class="mt-3">
                    <label for="leaveType_id" class="block text-sm font-medium text-gray-700"
                      >Leave Type:</label
                    >
                    <select
                      id="leaveType_id"
                      v-model="leaveRequest.leaveType_id"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    >
                      <option value="" disabled>Select a leave type</option>
                      <option
                        v-for="leaveType in leaveTypeStore.leaveTypes"
                        :key="leaveType.id"
                        :value="leaveType.id"
                      >
                        {{ leaveType.leave_name }}
                      </option>
                    </select>
                  </div>

                  <div>
                    <!-- Leave Duration (Full Day, Half Day, Specific Time) -->
                    <div class="mt-3">
                      <label for="leave_type" class="block text-sm font-medium text-gray-700">
                        Leave Duration
                      </label>
                      <select
                        v-model="duration"
                        id="leave_type"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                      >
                        <option value="full_day">Full Day</option>
                        <option value="half_day">Half Day</option>
                        <option value="time">Specific Time</option>
                      </select>
                    </div>

                    <!-- Half Day Type (Morning, Afternoon) -->
                    <div v-if="duration === 'half_day'" class="mt-3">
                      <label class="block text-sm font-medium text-gray-700">
                        Select Half Day Type
                      </label>
                      <div class="mt-2">
                        <label class="inline-flex items-center">
                          <input
                            type="radio"
                            name="half_day_type"
                            value="morning"
                            v-model="leaveRequest.half_day_type"
                            class="form-radio text-blue-600"
                          />
                          <span class="ml-2">Morning</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                          <input
                            type="radio"
                            name="half_day_type"
                            value="afternoon"
                            v-model="leaveRequest.half_day_type"
                            class="form-radio text-blue-600"
                          />
                          <span class="ml-2">Afternoon</span>
                        </label>
                      </div>
                    </div>

                    <!-- From Date/Time -->
                    <div v-if="duration === 'full_day'" class="mt-3">
                      <label for="from_date" class="block text-sm font-medium text-gray-700">
                        From Date
                      </label>
                      <input
                        type="date"
                        id="from_date"
                        v-model="leaveRequest.from_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                      />
                    </div>

                    <!-- To Date -->
                    <div v-if="duration === 'full_day'" class="mt-3">
                      <label for="to_date" class="block text-sm font-medium text-gray-700">
                        To Date
                      </label>
                      <input
                        type="date"
                        id="to_date"
                        v-model="leaveRequest.to_date"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                      />
                    </div>

                    <!-- Specific Time -->
                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="start_time" class="block text-sm font-medium text-gray-700">
                        Start Time
                      </label>
                      <input
                        type="time"
                        id="start_time"
                        v-model="leaveRequest.start_time"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                      />
                    </div>

                    <div v-if="duration === 'time'" class="mt-3">
                      <label for="end_time" class="block text-sm font-medium text-gray-700">
                        End Time
                      </label>
                      <input
                        type="time"
                        id="end_time"
                        v-model="leaveRequest.end_time"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                      />
                    </div>
                  </div>

                  <!-- <div>
                    <label for="start_time">Start Time:</label>
                    <input
                      id="start_time"
                      v-model="leaveRequest.start_time"
                      type="time"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div>
                  <div>
                    <label for="end_time">End Time:</label>
                    <input
                      id="end_time"
                      v-model="leaveRequest.end_time"
                      type="time"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div>
                  <div>
                    <label for="from_date">From Date:</label>
                    <input
                      id="from_date"
                      v-model="leaveRequest.from_date"
                      type="date"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div>
                  <div>
                    <label for="to_date">To Date:</label>
                    <input
                      id="to_date"
                      v-model="leaveRequest.to_date"
                      type="date"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div> -->
                </div>
                <div class="w-6/12">
                  <!-- <div class="mt-4">
                    <label for="total_requested_days">Total Requested Days:</label>
                    <input
                      id="total_requested_days"
                      v-model="leaveRequest.total_requested_days"
                      type="number"
                      min="1"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div> -->
                  <!-- <div>
                    <label for="status">Status:</label>
                    <input
                      id="status"
                      v-model="leaveRequest.status"
                      type="text"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    />
                  </div> -->

                  <div>
                    <label for="reason">Reason:</label>
                    <textarea
                      id="reason"
                      v-model="leaveRequest.reason"
                      placeholder="Reason for leave"
                      required
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm"
                    ></textarea>
                  </div>

                  <div class="flex flex-col items-center justify-center w-full mt-3">
                    <label
                      for="dropzone-file"
                      class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                    >
                      <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg
                          class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 20 16"
                        >
                          <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                          />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                          <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          SVG, PNG, JPG, or GIF (MAX. 800x400px)
                        </p>
                      </div>
                      <input
                        id="dropzone-file"
                        type="file"
                        class="hidden"
                        multiple
                        @change="handleFileUpload"
                      />
                    </label>

                    <!-- Display Selected Files -->
                    <ul class="mt-4 w-full space-y-2">
                      <li
                        v-for="(file, index) in selectedFiles"
                        :key="index"
                        class="p-2 text-sm text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-300"
                      >
                        {{ file.name }} - {{ formatFileSize(file.size) }}
                      </li>
                    </ul>
                  </div>

                  <button
                    type="submit"
                    class="mt-6 bg-gray-900 text-white font-semibold px-2 py-1 mr-3 rounded-lg shadow-md hover:bg-yellow-400 transition-colors border-none"
                  >
                    Take Leave
                  </button>
                </div>
              </form>

              <div v-if="requestStatus === 'success'" class="text-green">
                Leave request submitted successfully!
              </div>
              <div v-if="requestStatus === 'error'" class="text-danger">
                Error submitting leave request.
              </div>
            </div>
            <div class="container mx-auto mt-10 px-6 py-4">
              <div class="d-flex justify-center text-black mb-10">
                <h1 class="font-bold text-3xl hover:text-yellow-500">Team's Leave</h1>
              </div>
              <div class="flex justify-between mb-4">
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search employee..."
                  title="Type in an ID, Name, or Date"
                  class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md"
                />
                <div class="d-flex gap-2">
                  <a
                    href="/supervisor/takeleave/all/leavehistory"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors"
                  >
                    History
                  </a>
                  <a
                    href="/supervisor/requestleave/myleaved"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors"
                  >
                    My History
                  </a>
                </div>
              </div>
              <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-black">
                    <tr>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Staff ID
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Name
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Type
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        From
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        To
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Half Day
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Files
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Status
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Total
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Detail
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Approver
                      </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="request in leaveRequestStore.leaveRequests"
                      :key="request.id"
                      class="hover:bg-gray-50"
                    >
                      <td class="py-4 px-2 text-sm text-center text-black">
                        {{ request.staff_id }}
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">
                        {{ request.employee_name }}
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">
                        {{ request.leave_type }}
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">
                        <span v-if="request.start_time">{{ request.start_time }}</span>
                        <span v-else>{{ request.from_date }}</span>
                      </td>

                      <td class="py-4 px-2 text-sm text-center text-black">
                        <span v-if="request.end_time">{{ request.end_time }}</span>
                        <span v-else>{{ request.to_date }}</span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">
                        <span v-if="request.start_time && request.end_time">time</span>
                        <span v-else>{{ request.half_day_type }}</span>
                      </td>
                      <!-- Display attachment -->
                      <td class="py-4 px-6 text-sm text-center text-black">
                        <div class="flex gap-2">
                          <img
                            :src="request.attachment"
                            class="max-h-5 max-w-full object-cover mb-2 cursor-pointer"
                          />
                          <a href="#" @click.prevent="viewFile(leaveRequest)">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-6 text-sm d-flex justify-center">
                        <span
                          :class="{
                            'bg-yellow-400 text-black': request.status === 'Pending',
                            'bg-green-500 text-white': request.status === 'Approved',
                            'bg-red-500 text-white': request.status === 'Rejected'
                          }"
                          class="text-center px-3 py-2 rounded-full text-xs font-semibold"
                        >
                          {{ request.status }}
                        </span>
                      </td>

                      <td class="py-4 px-2 text-sm text-center text-black">
                        {{ request.total_requested_days }}
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <router-link
                          :to="{ name: 'viewLeaveDetail', params: { id: request.id } }"
                          class="text-blue-700 no-underline hover:text-blue-300"
                        >
                          View
                        </router-link>
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <span v-if="request.approved_by">{{ request.approved_by }}</span>
                        <span v-if="request.rejected_by">{{ request.rejected_by }}</span>
                        <span v-else>Pending</span>
                      </td>
                      <td class="text-sm px-2 font-medium text-center">
                        <div class="flex justify-center mt-2 space-x-2">
                          <button
                            class="bg-gray-900 text-white px-2 py-1 rounded-md shadow-md hover:bg-yellow-500 transition-all duration-300 ease-in-out font-semibold border-none"
                            @click="approveLeave(request)"
                          >
                            Approve
                          </button>
                          <button
                            class="bg-red-500 text-white px-2 py-1 rounded-md shadow-md hover:bg-red-400 transition-all duration-300 ease-in-out font-semibold border-none"
                            @click="rejectLeave(request)"
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
          </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
import { useLeaveTypeStore } from '@/stores/leave-type' // Import the store

// Components registration (for the template section)
defineProps({ components: { SupervisorSidebar, WebHeaderMenu } })

// Access the leave request store
const leaveRequestStore = useLeaveRequestStore()

const leaveTypeStore = useLeaveTypeStore()

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

const duration = ref('full_day') // Selected leave type (default: Full Day)

const requestStatus = ref(null) // Status of the leave request

const addSeconds = (time) => (time ? `${time}:00` : '')

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