<template>
    <div class="mt-10 p-10">
      <div class="flex border-b-2 border-gray-300 px-8 h-20 items-center">
        <router-link to="/admin/leave">
          <svg class="mb-5 w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </router-link>
        <h1 class="font-bold mr-20 text-3xl w-2/6 mt-3 hover:text-yellow-400"><b>Request Leave</b></h1>
      </div>
  
      <div class="container mt-16 px-6 py-4 bg-white shadow-md rounded-lg">
        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="flex flex-row justify-between px-5 py-5 gap-5">
          <div class="w-6/12">
            <div>
              <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label>
              <select v-model="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Select an Employee</option>
                <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                  {{ employee.full_name }} | Role: {{ employee.roles.map(role => role.name).join(', ') }}
                </option>
              </select>
            </div>
  
            <div class="mt-4">
              <label for="leave_type_id" class="block text-sm font-medium text-gray-700">Leave Type</label>
              <select v-model="leave_type_id" id="leave_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
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
              <label for="from_date" :id="fromDateLabelId" class="block text-sm font-medium text-gray-700">From Date/Time</label>
              <input v-model="from_date" type="datetime-local" id="from_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
  
            <div class="mt-4">
              <label for="to_date" :id="toDateLabelId" class="block text-sm font-medium text-gray-700">To Date/Time</label>
              <input v-model="to_date" type="datetime-local" id="to_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
  
            <div class="mt-4">
              <label for="leave_duration" class="block text-sm font-medium text-gray-700">Leave Duration</label>
              <select v-model="leave_duration" id="leave_duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="full_day">Full Day</option>
                <option value="half_day">Half Day</option>
                <option value="time">Specific Time</option>
              </select>
            </div>
  
            <div v-if="leave_duration === 'half_day'" class="mt-4">
              <label class="block text-sm font-medium text-gray-700">Select Half Day Type</label>
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
              <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
              <textarea v-model="reason" id="reason" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4" placeholder="Enter the reason for your leave"></textarea>
            </div>
  
            <div class="mt-4">
              <label for="duration" class="block text-sm font-medium text-gray-700">Duration (in days)</label>
              <input v-model="duration" type="number" id="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" step="0.5" placeholder="Enter duration in days">
            </div>
  
            <div class="mt-4">
              <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
              <input type="file" @change="handleFileUpload" multiple accept=".jpg,.jpeg,.png,.gif,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf">
            </div>
  
            <div class="mt-6">
              <button type="submit" class="bg-black text-white font-semibold px-2 py-1 rounded-lg shadow-md hover:bg-yellow-400 transition-colors">Take Leave</button>
              <router-link to="/admin/leave" class="bg-red-600 text-white font-semibold px-2 py-1 rounded-lg shadow-md hover:bg-red-400 transition-colors">Back</router-link>
            </div>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
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
  };
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  </style>
  