<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu/>
        <main class="bg-gray sticky mt-5 p-5">
      
      <!-- Header with Back button and Title -->
      <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
        <router-link to="/Supervisor/Settings">
          <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </router-link>
        <h1 class="font-bold text-3xl mt-2 px-8 hover:text-yellow-400 w-3/12"><b>Leave Types</b></h1>
      </div>
      <div class="container mx-auto px-6 py-1">
        <!-- Create new Leave Type Button -->
        <div class="flex justify-end" v-if="canCreate">
          <router-link to="/admin/leavetype/create" class="bg-black text-white font-bold mt-3 px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">
            Add New Type
          </router-link>
        </div>

        <!-- Leave Types List -->
        <div class="container mx-auto mt-5">
          <h6 class="text-center text-2xl font-bold mb-6">All Leave Types</h6>
          <table class="min-w-full divide-y mb-5 divide-gray-200" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
            <thead class="bg-black">
              <tr>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Employee</th>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Leave Type</th>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Requires Attachment</th>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Auto Increase Entitlement</th>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Increase Rate</th>
                <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="leaveType in leaveTypes" :key="leaveType.id" class="hover:bg-gray-100">
                <td class="py-4 px-6 border-b border-gray-200">
                  {{ leaveType.employee.full_name }}
                  <br />
                  <p>
                    <span class="text-blue-500 font-bold">{{ leaveType.employee.staff_id }}</span> |
                    <span class="text-blue-500">{{ leaveType.employee.gender }}</span> |
                    <span class="text-xs">joined: {{ leaveType.employee.joined_date }}</span>
                  </p>
                  <p class="text-xs">
                    {{ leaveType.employee.department.name || 'No department' }} |
                    {{ leaveType.employee.position.name || 'No position' }}
                  </p>
                </td>
                <td class="py-4 px-6 border-b border-gray-200">{{ leaveType.leave_name }}</td>
                <td class="py-4 px-6 text-center border-b border-gray-200">{{ leaveType.requires_attachment ? 'Yes' : 'No' }}</td>
                <td class="py-4 px-6 text-center border-b border-gray-200">{{ leaveType.auto_increase_entitlement ? 'Yes' : 'No' }}</td>
                <td class="py-4 px-6 text-center border-b border-gray-200">{{ leaveType.increase_rate }} days/year</td>
                <td class="py-4 px-6 border-b border-gray-200 text-right">
                  <router-link v-if="canEdit" :to="`/admin/leavetype/edit/${leaveType.id}`" class="text-white font-bold py-1 px-3 rounded text-xs bg-black hover:bg-yellow-400">Edit</router-link>
                  <button v-if="canDelete" @click="deleteLeaveType(leaveType.id)" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import axios from 'axios';

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      leaveTypes: [], // Holds fetched leave types data
      canCreate: false, // Permission to create leave types
      canEdit: false,   // Permission to edit leave types
      canDelete: false, // Permission to delete leave types
    };
  },
  created() {
    this.fetchLeaveTypes();
    this.checkPermissions(); // Check user permissions for create/edit/delete
  },
  methods: {
    async fetchLeaveTypes() {
      try {
        const response = await axios.get('/api/leavetypes'); // Fetch leave types
        this.leaveTypes = response.data;
      } catch (error) {
        console.error('Error fetching leave types:', error);
      }
    },
    async deleteLeaveType(id) {
      if (confirm('Are you sure you want to delete this leave type?')) {
        try {
          await axios.delete(`/api/leavetypes/${id}`); // API call to delete leave type
          this.fetchLeaveTypes(); // Refresh the list
        } catch (error) {
          console.error('Error deleting leave type:', error);
        }
      }
    },
    checkPermissions() {
      // Fetch permissions (could be from API or user store)
      this.canCreate = true; // Set based on actual permissions
      this.canEdit = true;   // Set based on actual permissions
      this.canDelete = true; // Set based on actual permissions
    },
  },
};
</script>


<style scoped>
.supervisor{
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #E5E7EB;
}
.sidebar{
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main{
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #E5E7EB;
  margin-bottom: 50px;
}

</style>