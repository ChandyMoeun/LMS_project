<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="mt-5">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/Supervisor/Settings/LeaveType">
                    <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4" />
                    </svg>
                </router-link>
                <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-3/12 px-8"><b>Edit Types</b></h1>
                </div>
                <div class="container mx-auto px-6 py-8 mt-5">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <!-- Form for Editing Leave Type -->
                    <form @submit.prevent="submitForm">
                    <!-- Leave Name -->
                    <div class="mb-4">
                        <label for="leave_name" class="block text-sm font-medium text-gray-700">Leave Name</label>
                        <input v-model="leaveType.leave_name" type="text" id="leave_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
        
                    <!-- Employee Selection -->
                    <div class="mb-4">
                        <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label>
                        <select v-model="leaveType.employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                            {{ employee.full_name }}
                        </option>
                        </select>
                    </div>
        
                    <!-- Requires Attachment -->
                    <div class="mb-4">
                        <label for="requires_attachment" class="block text-sm font-medium text-gray-700">Requires Attachment</label>
                        <input v-model="leaveType.requires_attachment" type="checkbox" id="requires_attachment" class="mt-1">
                    </div>
        
                    <!-- Auto Increase Entitlement -->
                    <div class="mb-4">
                        <label for="auto_increase_entitlement" class="block text-sm font-medium text-gray-700">Auto Increase Entitlement</label>
                        <input v-model="leaveType.auto_increase_entitlement" type="checkbox" id="auto_increase_entitlement" class="mt-1">
                    </div>
        
                    <!-- Increase Rate -->
                    <div class="mb-4">
                        <label for="increase_rate" class="block text-sm font-medium text-gray-700">Increase Rate (days/year)</label>
                        <input v-model="leaveType.increase_rate" type="number" id="increase_rate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
        
                    <!-- Form Buttons -->
                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Submit Button -->
                        <button type="submit" class="bg-yellow-500 border-none text-white font-bold px-5 py-2 rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring">
                        Update
                        </button>
                    </div>
                    </form>
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
      leaveType: {
        leave_name: '', // Adjust initial values as needed
        employee_id: null,
        requires_attachment: false,
        auto_increase_entitlement: false,
        increase_rate: null
      },
      employees: [] // Load employee data dynamically
    }
  },
  mounted() {
    this.loadLeaveType()
    this.loadEmployees()
  },
  methods: {
    loadLeaveType() {
      // Fetch leaveType data from API or props, e.g.:
      // this.leaveType = fetchedLeaveType;
    },
    loadEmployees() {
      // Fetch employee list from API
      // this.employees = fetchedEmployees;
    },
    submitForm() {
      // Handle form submission, e.g., API call to update leave type
      console.log(this.leaveType)
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
  