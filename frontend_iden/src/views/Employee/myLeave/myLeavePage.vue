<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0">
          <div class="mt-5 pb-20">
            <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <h1 class="font-bold mr-20 text-3xl px-8 w-3/12 mt-3 hover:text-yellow-400"><b>Request Leave</b></h1>
            </div>
            <div class="flex justify-end items-end mt-16 mb-3">
              <a href="/employee/myleave/historyleave" class=" mr-10 px-3 py-1 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">My History</a>
            </div>
            <div class="container mt-2 px-6 py-4 bg-white shadow-md rounded-lg">
              <form @submit.prevent="submitForm" enctype="multipart/form-data" class="flex flex-row justify-between p-3 gap-5">
                <div class="w-6/12">
                  <div class="username">
                    <label for="username" class="block text-sm font-medium text-black">Your Name</label>
                    <input v-model="user_name" value="user_name" id="user_name" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm" placeholder="Enter your name">
                      {{ user_name }}
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
                  <div class="mt-6">
                    <button type="submit" class="bg-gray-900 text-white font-semibold px-2 py-1 mr-3 rounded-lg shadow-md hover:bg-yellow-400 transition-colors border-none">Take Leave</button>
                  </div>
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
                      <th class="py-2 px-2 text-center border-b">Approver</th>
                      <th class="py-2 px-2 text-center border-b">Sub-approver</th>
                      <th class="py-2 px-2 text-center border-b">Status</th>
                      <th class="py-2 px-2 text-center border-b">Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(request, index) in leaveRequests" :key="index" class="hover:bg-white text-xs">
                      <td class="py-2 px-2 text-center border-b">{{ request.id }}</td>
                      <td class="py-2 px-2 text-center border-b">{{ request.name }}</td>
                      <td class="py-2 px-2 text-center border-b">{{ request.type }}</td>
                      <td class="py-2 px-2 text-center border-b">{{ request.date }}</td>
                      <td class="py-2 px-2 text-center border-b">{{ request.approver }}</td>
                      <td class="py-2 px-2 text-center border-b">{{ request.subApprover }}</td>
                      <td class="py-2 px-2 text-center border-b">
                        <span :class="statusClass(request.status)">{{ request.status }}</span>
                      </td>
                      <td class="py-2 px-2 text-center border-b text-xs">
                        <a href="/employee/myleave/view/detail" class="text-blue-500 no-underline hover:text-blue-400">More</a>
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
  
<script>
  import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
  import { ref } from 'vue';
  export default {
    components: {EmployeeSidebar, WebHeaderMenu},
  methods: {
        setup() {
            const user_name = ref('');
            const leave_type_id = ref('');
            const from_date = ref('');
            const to_date = ref('');
            const leave_duration = ref('full_day');
            const half_day_type = ref('');
            const reason = ref('');
            const duration = ref(1);
            const leaveRequests = ref([]);
            const leaveTypes = ref([
            { id: 1, leave_name: 'Annual leave' },
            { id: 2, leave_name: 'Sick leave' },
            { id: 3, leave_name: 'Personal leave' },
            { id: 4, leave_name: 'ML' }
        ]);
        const eligibleForAnnualLeave = ref(true);
          const handleFileUpload = (event) => {
          const files = event.target.files;
          // Handle file upload
          };
        const submitForm = () => {
        // Create the new leave request object
        const newLeaveRequest = {
          id: leaveRequests.value.length + 1,  // Create a simple incremental ID
          name: user_name.value,
          type: leaveTypes.value.find(type => type.id === leave_type_id.value)?.leave_name || '',
          position: 'Developer',  // This can be dynamic if needed
          date: `${from_date.value} - ${to_date.value}`,
          approver: 'Approver',  // Placeholder; can be dynamic
          subApprover: 'Sub-approver',  // Placeholder; can be dynamic
          status: 'Pending'
        };
  
        // Add the new leave request to the leaveRequests array
        leaveRequests.value.push(newLeaveRequest);
  
        // Clear form inputs after submission
        user_name.value = '';
        leave_type_id.value = '';
        from_date.value = '';
        to_date.value = '';
        leave_duration.value = 'full_day';
        half_day_type.value = '';
        reason.value = '';
        duration.value = 1;
  
        // If you want to send the data to the server after submitting the form:
        // axios.post('/admin/leave/store', newLeaveRequest)
        //   .then(response => {
        //     console.log('Leave submitted:', response.data);
        //   })
        //   .catch(error => {
        //     console.error('Error submitting leave:', error);
        //   });
      };
          return {
          user_name,
          leave_type_id,
          from_date,
          to_date,
          leave_duration,
          half_day_type,
          reason,
          duration,
          leaveRequests,  // Expose leaveRequests to the template
          leaveTypes,
          eligibleForAnnualLeave,
          handleFileUpload,
          submitForm
          };
      }
    }
};
    // Sample data for leave requests
  const leaveRequests = ref([
    { id: 1, name: 'John Doe', type: 'Sick Leave', position: 'Developer', date: '12.02.2024 | 12.03.2024', approver: 'Approver1', subApprover: 'Sub1', status: 'Pending' },
    { id: 2, name: 'Jane Doe', type: 'Annual Leave', position: 'Designer', date: '01.01.2024 | 01.02.2024', approver: 'Approver2', subApprover: 'Sub2', status: 'Approved' }
  ]);
  
  const dropdownVisible = ref(null);
  
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
  .employee {
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