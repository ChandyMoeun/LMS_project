<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="sticky top-0">
          <div class="mt-10">
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/Supervisor/takeLeave">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12">
                <b>Team leaves History</b>
              </h1>
            </div>

            <div class="container mx-auto">
              <h5 class="flex justify-center mt-20 font-bold text-3xl text-black">
                <b>All Approveed leaves</b>
              </h5>
              <div class="flex justify-between items-end mb-3">
                <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or aprover Name" class="w-2/6 h-9 px-2 border rounded rounded-lg shadow-md"/>
                <a href="/supervisor/takeleave/all/leavehistory/rejecthistory"
                  class="mr-10 px-3 py-1 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">All rejected leaves
                </a >
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
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">approve on</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Total</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Detail</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Approver</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="leaveRequest in filteredLeaveRequests" :key="leaveRequest.id" class="hover:bg-gray-100"> 
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.staff_id }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.full_name }}</td>
                      <td class="py-4 text-center px-2 text-sm text-black">{{ leaveRequest.leave_name }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.from_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.to_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.half_day }}</td>

                      <!-- Display attachment -->
                      <td>
                        <div class="flex gap-2 justify-center">
                          <img :src="leaveRequest.file_url" class="max-h-5 cursor-pointer" />
                          <a href="#">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <span :class="statusClasses(leaveRequest.status)" class="px-2 py-1 rounded-full text-xs font-semibold">{{ leaveRequest.status }}</span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.approve_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.total_requested_days }}</td>
                      <td class="py-4 px-2 text-sm text-center"><a href="/supervisor/takeleave/view/leavedetail" class="text-blue-600 no-underline hover:text-blue-400">View</a></td>
                      <td class="py-4 px-2 text-sm text-center">{{ leaveRequest.approver}}</td>
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
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      searchQuery: '',
      leaveRequests: [
        {
          id: 2,
          staff_id: '002',
          full_name: 'Gyver King',
          leave_name: 'AL',
          from_date: '2024-09-02',
          to_date: '2024-09-04',
          half_day: 'Full day',
          status: 'Approved',
          approver: 'Mr. Cat',
          total_requested_days: 3,
          approve_date: '2024-09-01',
          file_url: '#',
        },
        // Additional leave requests can be added here
      ]
    }
  },
  computed: {
    filteredLeaveRequests() {
      return this.leaveRequests.filter(
        (leave) =>
          leave.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          leave.staff_id.includes(this.searchQuery)
      )
    }
  },
  methods: {
    statusClasses(status) {
      return {
        'bg-yellow-400 text-black': status === 'Pending',
        'bg-green-500 text-white': status === 'Approved',
        'bg-red-500 text-white': status === 'Rejected',
      }
    }
  }
}
</script>

<style scoped>
.supervisor {
    display: flex;
    height: 100vh;
    align-items: start;
    width: 100%;
  }
  .sidebar {
    width: 17%;
    height: auto;
  }
  .container-page {
    width: 83%;
  }
  main {
    padding: 50px 50px 0px 50px;
    height: auto;
    width: 100%;
    background-color: #EEEDED;
    margin-bottom: 50px;
  }
</style>