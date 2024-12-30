<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-5 px-10">
            <!-- Admin Requests leave -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-3/12"> <b>My History</b> </h1>
              <p class="px-8">Number of leaves:</p>
            </div>
            <div class="container mx-auto mt-16 px-6 py-4">
              <div class="flex justify-between mb-3">
                <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or aprover Name" class="w-2/6 py-2 px-2 h-9 border rounded rounded-lg shadow-md" />
                <a href="/Supervisor/takeLeave" class="mr-5 px-3 mt-1 py-1 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-400 transition-colors no-underline">Back</a >
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
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> approve on </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Total </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Detail </th>
                      <th class="py-3 px-2 text-center text-xs text-white uppercase tracking-wider"> Acceptor </th>
                    </tr>
                  </thead>
                    <tbody v-for="leaveRequest in filteredLeaveRequests" :key="leaveRequest.id">
                    <tr v-if=" (leaveRequest.employee_id === user.id && leaveRequest.status === 'approved') || leaveRequest.status === 'rejected'" class="hover:bg-gray-50" >
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.staff_id }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.employee_name }}</td>
                      <td class="py-4 text-center px-2 text-sm text-black">{{ leaveRequest.leave_type }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.from_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.to_date }}</td>
                      <td class="py-4 px-2 text-sm text-center text-black">{{ leaveRequest.half_day_type }}</td>
                       <!-- Display attachment -->
                      <td class="py-4 px-6 text-sm text-center text-black">
                        <div class="flex gap-2 justify-center">
                          <img :src="leaveRequest.file_url" class="max-h-5 cursor-pointer" />
                          <a href="#">See More</a>
                        </div>
                      </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <div>
                          <span
                            :class="{
                              'bg-yellow-400 text-black': leaveRequest.status === 'pending',
                              'bg-green-500 text-white': leaveRequest.status === 'approved',
                              'bg-red-500 text-white': leaveRequest.status === 'rejected'
                            }"
                            class="text-center px-3 py-2 rounded-full text-xs font-semibold" > {{ leaveRequest.status }}
                          </span>
                        </div>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black">
                        <span v-if="leaveRequest.status === 'approve'">{{ leaveRequest.created_at }}</span>
                        <span v-else>{{ leaveRequest.updated_at }}</span>
                      </td>
                      <td class="py-4 px-2 text-sm text-center text-black"> {{ leaveRequest.total_requested_days }} </td>
                      <td class="py-4 px-2 text-sm text-center">
                        <a href="/supervisor/requestleave/myleaved/viewhistory" class="text-blue-700 no-underline hover:text-blue-300">View</a>
                      </td>
                      <td class="d-flex flex-col py-4 text-center text-sm text-gray-500">
                        <span v-if="leaveRequest.approved_by">{{ leaveRequest.approved_by }}</span>
                        <span v-else-if="leaveRequest.rejected_by">{{ leaveRequest.rejected_by }}</span>
                        <span v-else>No approver</span>
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

<script setup>
import { ref, computed, onMounted } from 'vue'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
import { userAuthStore } from '@/stores/get-me' 
const authStore = userAuthStore()
const user = authStore.user
console.log(user)
const searchQuery = ref('')
const leaveRequestStore = useLeaveRequestStore()

// ===>Function to fetch leave requests (example for leaveRequestStore)<=====
const fetchTeamLeaveRequests = async () => {
  try {
    await leaveRequestStore.fetchTeamLeaveRequests()
    console.log('Fetched leave requests:', leaveRequestStore.leaveRequests)
  } catch (error) {
    console.error('Error fetching leave requests:', error)
  }
}
// ====>Fetch leave requests on component mount<====
onMounted(() => {
  fetchTeamLeaveRequests();
});
// ====>Computed property for filtered leave requests<====
const filteredLeaveRequests = computed(() => {
  const query = searchQuery.value.toLowerCase();
  return leaveRequestStore.leaveRequests.filter(
    (leave) =>
      leave.employee_name.toLowerCase().includes(query) ||
      leave.staff_id.includes(query) ||
      leave.from_date.includes(query)
  );
});
</script>