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
              style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-3/12">
                <b>Request Leave</b>
              </h1>
            </div>
            <div class="mt-10 px-6 py-4 bg-white shadow-md rounded-lg">
              <form @submit.prevent="submitForm" enctype="multipart/form-data" class="flex flex-row justify-between p-3 gap-5">
                    <div class="w-6/12">
                      <div>
                        <label for="employee_id" class="block text-sm font-medium text-black">Select Employee</label>
                        <select v-model="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm">
                          <option value="">Select an Employee</option>
                          <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                            {{ employee.full_name }} | Role: {{ employee.roles.map(role => role.name).join(', ') }}
                          </option>
                        </select>
                      </div>
                      <div class="mt-4">
                        <label for="leave_type_id" class="block text-sm font-medium text-black">Leave Type</label>
                        <select v-model="leave_type_id" id="leave_type_id" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" required>
                          <option value="" disabled>Select Leave Type</option>
                          <option v-for="leaveType in leaveTypes" :key="leaveType.id" :value="leaveType.id" 
                            :disabled="leaveType.leave_name === 'Annual leave' && !eligibleForAnnualLeave">
                            {{ leaveType.leave_name }} ({{ leaveType.id }})
                          </option>
                        </select>
                      </div>
                      <div v-if="leaveTypeDetailsVisible" class="mt-4">
                        <p>Total Leave: <span>{{ totalLeave }}</span></p>
                      </div>
                      <div class="mt-4">
                        <label for="from_date" :id="fromDateLabelId" class="block text-sm font-medium text-black">From Date/Time</label>
                        <input v-model="from_date" type="datetime-local" id="from_date" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" required>
                      </div>
                      <div class="mt-4">
                        <label for="to_date" :id="toDateLabelId" class="block text-sm font-medium text-black">To Date/Time</label>
                        <input v-model="to_date" type="datetime-local" id="to_date" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" required>
                      </div>
                      <div class="mt-4">
                        <label for="leave_duration" class="block text-sm font-medium text-black">Leave Duration</label>
                        <select v-model="leave_duration" id="leave_duration" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm">
                          <option value="full_day">Full Day</option>
                          <option value="half_day">Half Day</option>
                          <option value="time">Specific Time</option>
                        </select>
                      </div>
                      <div v-if="leave_duration === 'half_day'" class="mt-4">
                        <label class="block text-sm font-medium text-black">Select Half Day Type</label>
                        <div class="mt-2">
                          <label class="inline-flex items-center">
                            <input type="radio" name="half_day_type" value="morning" v-model="half_day_type" class="form-radio text-blue-600">
                            <span class="ml-2">Morning</span>
                          </label>
                          <label class="inline-flex items-center ml-6">
                            <input type="radio" name="half_day_type" value="afternoon" v-model="half_day_type" class="form-radio text-blue-600">
                            <span class="ml-2">Afternoon</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="w-6/12">
                      <div>
                        <label for="reason" class="block text-sm font-medium text-black">Reason</label>
                        <textarea v-model="reason" id="reason" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4" placeholder="Enter the reason for your leave"></textarea>
                      </div>
                      <div class="mt-4">
                        <label for="duration" class="block text-sm font-medium text-black">Duration (in days)</label>
                        <input v-model="duration" type="number" id="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" step="0.5" placeholder="Enter duration in days">
                      </div>
                      <div class="mt-4">
                        <label for="attachment" class="block text-sm font-medium text-black">Attachment</label>
                        <input type="file" @change="handleFileUpload" multiple accept=".jpg,.jpeg,.png,.gif,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf">
                      </div>
                      <button type="submit" class="mt-6 bg-gray-900 text-white font-semibold px-2 py-1 mr-3 rounded-lg shadow-md hover:bg-yellow-400 transition-colors border-none">Take Leave</button>
                    </div>
                  </form>
                </div>
            <div class="container mx-auto mt-10 px-6 py-4">
              <div class="d-flex justify-center text-black mb-10">
                <h1 class="font-bold text-3xl hover:text-yellow-500">Team's Leave</h1>
              </div>
              <div class="flex justify-between mb-4">
                <input v-model="searchQuery" type="text" placeholder="Search employee..." title="Type in an ID, Name, or Date" class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md"/>
                <div class="d-flex gap-2">
                  <a
                    href="/supervisor/takeleave/all/leavehistory"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">
                  History
                  </a>
                  <a
                    href="/supervisor/requestleave/myleaved"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">
                    My History
                  </a>
                </div>
              </div> 
              <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-black">
                    <tr>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Staff ID</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Name</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Type</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">From</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">To</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Half Day</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Files</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Status</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Total</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Detail</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Approver</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="leaveRequest in filteredLeaveRequests" :key="leaveRequest.id" class="hover:bg-gray-50">
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.staff_id }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.full_name }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.leave_name }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.from_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.to_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.half_day }}</td>
                      <!-- Display attachment -->
                      <td class="py-4 px-6 text-sm text-center text-black">
                        <div class="flex gap-2">
                          <img :src="leaveRequest.file_url" class="max-h-5 max-w-full object-cover mb-2 cursor-pointer"/>
                          <a href="#" @click.prevent="viewFile(leaveRequest)">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-6 text-sm d-flex justify-center">
                       <span
                       :class="{
                            'bg-yellow-400 text-black': leaveRequest.status === 'Pending',
                            'bg-green-500 text-white': leaveRequest.status === 'Approved',
                            'bg-red-500 text-white': leaveRequest.status === 'Rejected'
                          }" class="text-center px-3 py-2 rounded-full text-xs font-semibold">
                        {{ leaveRequest.status }}
                        </span>
                      </td>
                      
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.total_requested_days }}</td>
                      <td class="py-4 px-2 text-sm text-center">
                        <a href="/supervisor/takeleave/view/leavedetail" class="text-blue-700 no-underline hover:text-blue-300">View</a>
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <span v-if="leaveRequest.approver">{{ leaveRequest.approver }}</span>
                        <span v-if="leaveRequest.rejector">{{ leaveRequest.rejector }}</span>
                        <span v-else>Pending</span>
                      </td>
                      <td class="text-sm px-2 font-medium text-center">
                        <div class="flex justify-center mt-2 space-x-2">
                          <button class="bg-gray-900 text-white px-2 py-1 rounded-md shadow-md hover:bg-yellow-500 transition-all duration-300 ease-in-out font-semibold border-none" @click="approveLeave(leaveRequest)">Approve</button>
                          <button class="bg-red-500 text-white px-2 py-1 rounded-md shadow-md hover:bg-red-400 transition-all duration-300 ease-in-out font-semibold border-none" @click="rejectLeave(leaveRequest)">Reject</button>
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

<script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
  import { ref } from 'vue';
  import axios from 'axios';
export default {
  components: {SupervisorSidebar, WebHeaderMenu},
  data() {
    return {
      searchQuery: '',
    leaveRequests: [
    {
          id: 1,
          staff_id: '001',
          full_name: 'John Doe',
          leave_name: 'Sick Leave',
          from_date: '2024-10-10',
          to_date: '2024-10-11',
          half_day: 'Full day',
          status: 'Pending',
          approver: null,
          rejector: null,
          total_requested_days: 2,
          file_url: '#', // Add URL for file if available
        },
        {
          id: 2,
          staff_id: '002',
          full_name: 'Gyver King',
          leave_name: 'AL',
          from_date: '2024-09-02',
          to_date: '2024-09-04',
          half_day: 'Full day',
          status: 'Pending',
          approver: null,
          rejector: null,
          total_requested_days: 3,
          file_url: '#',
        },
      // Add more records as needed
    ],
    }
  },
  computed: {
  filteredLeaveRequests() {
    const query = this.searchQuery.toLowerCase();
    return this.leaveRequests.filter((leave) => 
      leave.full_name.toLowerCase().includes(query) ||
      leave.staff_id.includes(query) ||
      leave.from_date.includes(query) // Filter by from_date
    );
  }
},
methods: {
    approveLeave(leaveRequest) {
      leaveRequest.status = 'Approved';
    },
    rejectLeave(leaveRequest) {
      leaveRequest.status = 'Rejected';
      leaveRequest.rejector = 'Your Name'; // Adjust dynamically
    },
    viewFile(leaveRequest) {
      // Logic to view the attached file
      alert(`Viewing file for ${leaveRequest.full_name}`);
    },
  },
  setup() {
      const employee_id = ref('');
      const leave_type_id = ref('');
      const from_date = ref('');
      const to_date = ref('');
      const leave_duration = ref('full_day');
      const half_day_type = ref('');
      const reason = ref('');
      const duration = ref(1);
      const totalLeave = ref(0);
      const leaveTypeDetailsVisible = ref(false);
      const employees = ref([]); // Fetch this data from your API or props
      const leaveTypes = ref([]); // Fetch this data from your API or props
      const eligibleForAnnualLeave = ref(true); // Set this based on your business logic
      const handleFileUpload = (event) => {
        const files = event.target.files;
        // Handle file upload
      };
      const submitForm = () => {
        const formData = new FormData();
        formData.append('employee_id', employee_id.value);
        formData.append('leave_type_id', leave_type_id.value);
        formData.append('from_date', from_date.value);
        formData.append('to_date', to_date.value);
        formData.append('leave_duration', leave_duration.value);
        formData.append('half_day_type', half_day_type.value);
        formData.append('reason', reason.value);
        formData.append('duration', duration.value);
        // Add other form fields and handle attachments
        axios.post('/admin/leave/store', formData)
          .then(response => {
            console.log('Leave submitted:', response.data);
          })
          .catch(error => {
            console.error('Error submitting leave:', error);
          });
      };
      return {
        employee_id,
        leave_type_id,
        from_date,
        to_date,
        leave_duration,
        half_day_type,
        reason,
        duration,
        totalLeave,
        leaveTypeDetailsVisible,
        employees,
        leaveTypes,
        eligibleForAnnualLeave,
        handleFileUpload,
        submitForm
      };
    }
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