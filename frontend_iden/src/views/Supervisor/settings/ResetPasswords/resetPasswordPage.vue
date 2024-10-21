<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky mt-5">
          <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
            <router-link to="/Supervisor/Settings">
              <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
              </svg>
            </router-link>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-5/12"><b>Reset Password for Employees</b></h1>
          </div>
      
          <!-- <div v-if="employees.length === 0">
            <p>No employees found.</p>
          </div> -->
      
          <div class="mt-20">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
              <thead class="bg-black text-white">
                <tr>
                  <th class="py-3 px-5 text-left text-sm font-medium border-b">ID</th>
                  <th class="py-3 px-5 text-center text-sm font-medium border-b">Name</th>
                  <th class="py-3 px-5 text-center text-sm font-medium border-b">Email</th>
                  <th class="py-3 px-5 text-center w-3/12 text-sm font-medium border-b">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id" class="hover:bg-gray-50">
                  <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ employee.staff_id }}</td>
                  <td class="py-3 px-5 text-sm text-center border-b">{{ employee.full_name }}</td>
                  <td class="py-3 px-5 text-sm text-center text-gray-600 border-b">{{ employee.email }}</td>
                  <td class="py-3 px-5 text-center text-sm text-gray-600 border-b">
                    <router-link :to="{ name: 'resetPasswordForm', params: { id: employee.id } }" class="inline-block bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-400 transition duration-300">
                      Reset Password
                    </router-link>
                  </td>
                </tr> -->
                <tr class="hover:bg-gray-50">
                  <td class="py-3 px-5 text-sm text-gray-600 border-b">01</td>
                  <td class="py-3 px-5 text-sm text-center border-b">employees test1</td>
                  <td class="py-3 px-5 text-sm text-center text-gray-600 border-b">employee@gmail.com</td>
                  <td class="py-3 px-5 text-center text-sm text-gray-600 border-b">
                    <a href="/Supervisor/Settings/ResetPassword/Form" class="inline-block bg-yellow-500 no-underline text-white font-bold py-2 px-2 rounded-md hover:bg-black transition duration-300">Reset Password</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>
  
  <script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import axios from 'axios'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      employees: []
    }
  },
  created() {
    this.fetchEmployees()
  },
  methods: {
    async fetchEmployees() {
      try {
        const response = await axios.get('/api/employees') // Replace with actual API endpoint
        this.employees = response.data
      } catch (error) {
        console.error('Error fetching employees:', error)
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