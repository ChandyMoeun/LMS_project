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
                <b>Team's Leave</b>
              </h1>
              <p class="px-8">Total leaves: {{ leaveRequests.length }}</p>
            </div>
            <div class="container mx-auto mt-16 px-6 py-4">
              <div class="flex justify-between mb-4">
                <input v-model="searchQuery" type="text" placeholder="Search employee..." title="Type in an ID, Name, or Date" class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md"/>
                <div class="d-flex gap-2">
                  <a
                    href="/Supervisor/takeLeave/All/leaveHistory"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">
                  History
                  </a>
                  <a
                    href="/Supervisor/takeLeave/requestLeave"
                    class="bg-gray-900 text-white font-semibold px-3 py-1 mt-1 no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">
                    Request Leave
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
                        <a href="/Supervisor/takeLeave/view/leaveDetail" class="text-blue-700 no-underline hover:text-blue-300">View</a>
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