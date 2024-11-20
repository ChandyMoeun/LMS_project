<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main>
          <div class="mt-10 px-10">
            <!-- Admin Requests leave -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-3/12">
                <b>My History</b>
              </h1>
              <p class="px-8">Number of leaves:</p>
            </div>
            <div class="container mt-10 mx-auto px-6 py-4">
              <div class="flex justify-between mb-3">
                <input v-model="searchQuery" type="text" placeholder="Search..."
                    title="Type of leave or aprover Name"
                    class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md"/>
                  <div>
                    <a href="/employee/myleave/rejectedleave" class="mr-5 px-3 mt-1 py-2 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">Rejected Leave</a>
                    <a href="/employee/myleave" class="mr-5 px-3 mt-1 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">Back</a>
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
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">approve on</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Total</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Detail</th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider">Acceptor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="leaveRequest in filteredLeaveRequests" :key="leaveRequest.id" class="hover:bg-gray-50">
                    <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.staff_id }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.full_name }}</td>
                      <td class="py-4 text-center px-2 text-sm text-black">{{ leaveRequest.leave_name }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.from_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.to_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.half_day }}</td>

                      <!-- Display attachment -->
                      <td class="py-4 px-6 text-sm text-center text-black">
                        <div class="flex gap-2 justify-center">
                          <img :src="leaveRequest.file_url" class="max-h-5 cursor-pointer" />
                          <a href="#">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <span :class="statusClasses(leaveRequest.status)" class="px-2 py-1 rounded-full text-xs font-semibold">{{ leaveRequest.status }}</span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.accept_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.total_requested_days }}</td>
                      <td class="py-4 px-2 text-sm text-center">
                        <a href="/employee/myleave/historyleave/detail" class="text-blue-700 no-underline hover:text-blue-300">View</a>
                      </td>
                      <td class="d-flex flex-col py-4 text-center text-sm text-gray-500">
                        <span v-if="leaveRequest.approver">{{ leaveRequest.approver }}</span>
                        <span v-else>{{ leaveRequest.rejector }}</span>
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
  </EmployeeLayout>
</template>

<script>
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      searchQuery: '',
      leaveRequests: [
        {
          id: 1,
          staff_id: '001 ',
          full_name: 'Jiang Cheng ',
          leave_name: 'Sick Leve',
          from_date: '2024-09-02',
          to_date: '2024-09-04',
          half_day: 'Full day',
          status: ' Rejected',
          approver: null,
          rejector: 'Mr.cat', // Initially null, will be set upon rejection
          total_requested_days: 2,
          accept_date: '2024-09-01',
          file_url: '#',
        },
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
          rejector: null,
          total_requested_days: 3,
          accept_date: '2024-09-01',
          file_url: '#',
        },
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
    statusClasses(status) {
      return {
        'bg-red-500 text-white': status === 'Rejected',
        'bg-green-500 text-white': status === 'Approved',
      }
    }
  }
}
</script>

<style scoped>
.employee {
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