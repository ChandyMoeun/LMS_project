<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <div class="text-center mb-4">
        <p class="fs-4 fw-bold">Your journey to excellence starts here.</p>
        <p>Join Us Today and Get Started</p>
      </div>

      <!-- Display Positions -->
      <h2 class="text-center mb-4">Positions</h2>
      <table class="min-w-full bg-gray-100 border border-gray-100 mb-4">
        <thead>
          <tr class="bg-black text-white text-xs">
            <th class="py-2 px-2 text-center border-b">Position Name</th>
            <th class="py-2 px-2 text-center border-b">Department ID</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop through positions and display them in table rows -->
          <tr
            v-for="position in positionStore.positions"
            :key="position.id"
            class="hover:bg-white text-xs"
          >
            <td class="py-2 px-2 text-center border-b">{{ position.position }}</td>
            <td class="py-2 px-2 text-center border-b">{{ position.department }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Display Departments -->
      <h2 class="text-center mb-4">Departments</h2>
      <table class="min-w-full bg-gray-100 border border-gray-100 mb-4">
        <thead>
          <tr class="bg-black text-white text-xs">
            <th class="py-2 px-2 text-center border-b">Department Name</th>
            <th class="py-2 px-2 text-center border-b">Manager ID</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="department in departmentStore.departments"
            :key="department.id"
            class="hover:bg-white text-xs"
          >
            <td class="py-2 px-2 text-center border-b">{{ department.name}}</td>
            <td class="py-2 px-2 text-center border-b">{{ department.manager_name }}</td>
            <!-- <td v-for="position in department" :key="position.id" class="py-2 px-2 text-center border-b">{{ department}}</td> -->
          </tr>
        </tbody>
      </table>

      <!-- Display Leave Requests -->
      <h2 class="text-center mb-4">Leave Requests</h2>
      <table class="min-w-full bg-gray-100 border border-gray-100">
        <thead>
          <tr class="bg-black text-white text-xs">
            <th class="py-2 px-2 text-center border-b">Staff_ID</th>
            <th class="py-2 px-2 text-center border-b">Name</th>
            <th class="py-2 px-2 text-center border-b">Leave Type</th>
            <th class="py-2 px-2 text-center border-b">Half Day Type</th>
            <th class="py-2 px-2 text-center border-b">Start Time</th>
            <th class="py-2 px-2 text-center border-b">End Time</th>
            <th class="py-2 px-2 text-center border-b">Attachment</th>
            <th class="py-2 px-2 text-center border-b">Total Request Days</th>
            <th class="py-2 px-2 text-center border-b">From Date</th>
            <th class="py-2 px-2 text-center border-b">To Date</th>
            <th class="py-2 px-2 text-center border-b">Status</th>
            <th class="py-2 px-2 text-center border-b">Approved By</th>
            <th class="py-2 px-2 text-center border-b">Rejected By</th>
            <th class="py-2 px-2 text-center border-b">Reason</th>
            <th class="py-2 px-2 text-center border-b">Duration</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="leaveRequest in leaveRequestStore.leaveRequests"
            :key="leaveRequest.id"
            class="hover:bg-white text-xs"
          >
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.employee.staff_id }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.employee.full_name }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.leave_type.leave_name }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.half_day_type }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.start_time }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.end_time }}</td>
            <td class="py-2 px-2 text-center border-b">
              <img
                v-if="leaveRequest.attachment"
                :src="leaveRequest.attachment"
                alt="Attachment"
                class="w-20 h-20 object-cover"
              />
              <span v-else>No Image</span>
            </td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.total_requested_days }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.from_date }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.to_date }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.status }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.approved_by }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.rejected_by }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.reason }}</td>
            <td class="py-2 px-2 text-center border-b">{{ leaveRequest.duration }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </WebLayout>
</template>

<script>
import { useDepartmentStore } from '@/stores/department'
import { useLeaveRequestStore } from '@/stores/leave-request'
import { usePositionStore } from '@/stores/all-positions'
import { onMounted } from 'vue'

export default {
  setup() {
    const departmentStore = useDepartmentStore()
    const leaveRequestStore = useLeaveRequestStore()
    const positionStore = usePositionStore()

    // Fetch data on component mount
    onMounted(() => {
      departmentStore.fetchDepartments() // Fetch departments
      leaveRequestStore.fetchLeaveRequests() // Fetch leave requests
      positionStore.fetchPositions() // Fetch positions
      console.log(positionStore.fetchPositions())
    })

    return {
      departmentStore,
      leaveRequestStore,
      positionStore // Access positions from store
    }
  }
}
</script>

<style>
/* You can add custom styles here */
</style>
