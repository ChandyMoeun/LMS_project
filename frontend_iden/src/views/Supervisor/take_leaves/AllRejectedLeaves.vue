<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-10 px-10">
            <!-- Admin Requests leave -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-3/12"><b>Rejected</b></h1>
              <p class="px-8">Number of rejected:</p>
            </div> 
            <div class="container mx-auto mt-16 px-6 py-4">
              <div class="flex justify-between mb-3">
                <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or aprover Name" class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md"/>
                <a href="/supervisor/takeleave/all/leavehistory"
                  class="mr-5 px-3 mt-1 py-1 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">
                  Back
                </a>
              </div>
              <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-black">
                    <tr>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Staff ID </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Name </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Type </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> From </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> To </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Half Day </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Files </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Status </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Reject on </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Total </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Detail </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Rejecter </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="leaveRequest in filteredLeaveRequests" :key="leaveRequest.id" class="hover:bg-gray-50" >
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
                        <span :class="{ 'bg-red-500 text-white': leaveRequest.status === 'Rejected' }" class="text-center px-3 py-2 rounded-full text-xs font-semibold">
                        {{ leaveRequest.status }}
                        </span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.rejector_dade }}</td>
                        <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.total_requested_days }}</td>
                        <td class="py-4 px-2 text-sm text-center">
                          <a href="/supervisor/takeleave/view/leavedetail" class="text-blue-700 no-underline hover:text-blue-300">View</a>
                        </td>
                        <td class="d-flex flex-col py-4 text-center text-sm text-gray-500">
                          <span>{{ leaveRequest.rejector }}</span>
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
          staff_id: '001',
          full_name: 'John Doe',
          leave_name: 'Sick Leave',
          from_date: '2024-10-10',
          to_date: '2024-10-11',
          half_day: 'Full day',
          status: 'Rejected',
          rejector: 'Mr.cat',
          total_requested_days: 2,
          rejector_dade: '2024-09-01',
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
          status: 'Rejected',
          rejector: 'Mr.cat',
          total_requested_days: 3,
          rejector_dade: '2024-09-01',
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