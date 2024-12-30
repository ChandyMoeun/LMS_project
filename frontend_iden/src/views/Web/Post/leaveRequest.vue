<template>
  <div>
    <h2>Submit Leave Request</h2>
    <form @submit.prevent="handleSubmit">
      <div>
        <label for="employee_id">Employee ID:</label>
        <input id="employee_id" v-model="leaveRequest.employee_id" type="number" placeholder="Employee ID" required />
      </div>
      <div>
        <label for="leaveType_id">Leave Type ID:</label>
        <input id="leaveType_id" v-model="leaveRequest.leaveType_id" type="number" placeholder="Leave Type ID" required />
      </div>
      <div>
        <label for="half_day_type">Half Day Type:</label>
        <select id="half_day_type" v-model="leaveRequest.half_day_type">
          <option value="full_day">Full Day</option>
          <option value="AM">Morning (Half Day)</option>
          <option value="PM">Afternoon (Half Day)</option>
        </select>
      </div>
      <div>
        <label for="start_time">Start Time:</label>
        <input id="start_time" v-model="leaveRequest.start_time" type="time" required />
      </div>
      <div>
        <label for="end_time">End Time:</label>
        <input id="end_time" v-model="leaveRequest.end_time" type="time" required />
      </div>
      <div>
        <label for="total_requested_days">Total Requested Days:</label>
        <input id="total_requested_days" v-model="leaveRequest.total_requested_days" type="number" min="1" required />
      </div>
      <div>
        <label for="status">Status:</label>
        <input id="status" v-model="leaveRequest.status" type="text" required />
      </div>
      <div>
        <label for="from_date">From Date:</label>
        <input id="from_date" v-model="leaveRequest.from_date" type="date" required />
      </div>
      <div>
        <label for="to_date">To Date:</label>
        <input id="to_date" v-model="leaveRequest.to_date" type="date" required />
      </div>
      <div>
        <label for="reason">Reason:</label>
        <textarea id="reason" v-model="leaveRequest.reason" placeholder="Reason for leave" required></textarea>
      </div>
      <button type="submit">Submit Leave Request</button>
    </form>

    <div v-if="requestStatus === 'success'">Leave request submitted successfully!</div>
    <div v-if="requestStatus === 'error'">Error submitting leave request.</div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useLeaveRequestStore } from '@/stores/request-leave';

const leaveRequestStore = useLeaveRequestStore();
const requestStatus = ref(null);
const addSeconds = (time) => (time ? `${time}:00` : '');

const leaveRequest = ref({
  employee_id: null,
  leaveType_id: null,
  half_day_type: 'full_day', 
  end_time: '',
  total_requested_days: '',
  status: 'pending', 
  from_date: '',
  to_date: '',
  reason: '',
  attachment: null,
});

// ===>Handle form submission<=====
const handleSubmit = async () => {
  // ====>Format start_time and end_time with seconds<====
  leaveRequest.value.start_time = addSeconds(leaveRequest.value.start_time);
  leaveRequest.value.end_time = addSeconds(leaveRequest.value.end_time);
  if (new Date(leaveRequest.value.to_date) < new Date(leaveRequest.value.from_date)) {
    alert("The 'To Date' must be after or equal to the 'From Date'.");
    requestStatus.value = 'error';
    return;
  }
  try {
    await leaveRequestStore.submitLeaveRequest(leaveRequest.value);
    requestStatus.value = leaveRequestStore.requestStatus; 
  } catch (error) {
    requestStatus.value = 'error';
    console.error('Error submitting leave request:', error);
  }
};
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
}

label {
  margin: 10px 0 5px;
}

input, select, textarea {
  margin-bottom: 15px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
