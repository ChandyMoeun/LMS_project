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
              <router-link to="/Supervisor/takeLeave">
                <svg
                  class="w-6 h-6 text-gray-800 hover:text-gray-500"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 5H1m0 0 4 4M1 5l4-4"
                  />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12">
                <b>Employee leaves History</b>
              </h1>
            </div>

            <div class="container mx-auto">
              <h5 class="flex justify-center mt-20 font-bold text-3xl text-black">
                <b>All Approveed leaves</b>
              </h5>
              <div class="flex justify-between items-end mb-3">
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search..."
                  title="Type of leave or aprover Name"
                  class="w-2/6 h-9 px-2 border rounded rounded-lg shadow-md"
                />
                <a
                  href="/Supervisor/takeLeave/All/leaveHistory/rejectHistory"
                  class="mr-10 px-3 py-1 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline"
                  >All rejected leaves</a
                >
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
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="leaveRequest in filteredLeaveRequests"
                      :key="leaveRequest.id"
                      class="hover:bg-gray-50"
                    >
                      <td class="py-4 px-2 text-sm text-center text-black">001</td>
                      <td class="py-4 px-2 text-sm text-center text-black">UserName</td>
                      <td class="py-4 text-center px-2 text-sm text-black">sick leave</td>
                      <td class="py-4 px-2 text-sm text-center text-black">10.10.2024</td>
                      <td class="py-4 px-2 text-sm text-center text-black">10.11.2024</td>
                      <td class="py-4 px-2 text-sm text-center text-black">Full day</td>

                      <!-- Display attachment -->
                      <td class="py-4 px-6 text-sm text-center text-black">
                        <div class="flex gap-2">
                          <img
                            src="#"
                            class="max-h-5 max-w-full object-cover mb-2 cursor-pointer"
                          />
                          <a href="#">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-6 text-sm">
                        <span
                          :class="{
                            'bg-yellow-400 text-black': 'Pending',
                            'bg-green-500 text-white': 'Approved',
                            'bg-red-500 text-white': 'Rejected'
                          }"
                          class="text-center px-2 py-1 rounded-full text-xs font-semibold"
                        >
                          {{ leaveRequest.status }}
                        </span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">2</td>
                      <td class="py-4 px-2 text-sm text-center">
                        <a
                          href="/Supervisor/takeLeave/view/leaveDetail"
                          class="text-blue-700 no-underline hover:text-blue-300"
                          >View</a
                        >
                      </td>
                      <td class="d-flex flex-col py-4 text-center text-sm text-gray-500">
                        <span v-if="leaveRequest.approver">{{ leaveRequest.approver }}</span>
                        <span v-if="leaveRequest.rejector">{{ leaveRequest.rejector }}</span>
                        <span v-else>Pending</span>
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
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      searchQuery: '',
      leaveRequests: [
        {
          id: 1,
          staff_id: ' ',
          full_name: ' ',
          leave_name: ' ',
          from_date: ' ',
          to_date: ' ',
          half_day: ' ',
          status: ' rejected',
          approver: ' ',
          rejector: null, // Initially null, will be set upon rejection
          total_requested_days: 2
        }
      ]
    }
  },
  computed: {
    filteredLeaveRequests() {
      // Simple search filter logic
      return this.leaveRequests.filter(
        (leave) =>
          leave.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          leave.staff_id.includes(this.searchQuery)
      )
    }
  },
  methods: {
    approveLeave(leaveRequest) {
      // Logic for approving leave
      leaveRequest.status = 'Approved'
    },
    rejectLeave(leaveRequest) {
      // Logic for rejecting leave
      leaveRequest.rejector = 'Your Name' // Change this dynamically based on user
      leaveRequest.status = 'Rejected'
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