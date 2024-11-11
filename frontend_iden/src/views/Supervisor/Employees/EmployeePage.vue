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
            <!-- Employee Management Header -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"> <b>Team Management</b> </h1>
              <p class="px-8">Total members: {{ filteredEmployees.length }}</p>
            </div>

            <!-- Search and Filter select position-->
            <div class="flex justify-between mt-20 mb-7">
              <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or approver Name" class="w-2/6 h-9 px-2 border rounded rounded-lg shadow-md"/>
              <div class="flex items-center justify-end space-x-2 w-2/5">
                <button class="p-2 flex items-center border-none bg-gray-900 text-white font-bold h-9 px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors"
                  @click="addEmployee" >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                  </svg>
                  <a href="/supervisor/employee/create" class="no-underline text-white">Add</a>
                </button>
              </div>
            </div>

            <!-- Employee Table -->
            <div class="overflow-x-auto">
              <table class="w-full bg-white shadow-md rounded">
                <thead>
                  <tr class="header bg-black text-white">
                    <th class="p-3 text-left">Staff_id</th>
                    <th class="p-3 text-left">Profile</th>
                    <th class="p-3 text-center">Name</th>
                    <th class="p-3 text-center">Email</th>
                    <th class="p-3 text-center">Position</th>
                    <th class="p-3 text-center">Action</th>
                  </tr>
                </thead>
                <tbody  v-if="employees_list.length">
                  <tr v-for="employee in filteredEmployees" :key="employee.id" class="bg-gray-100 border-b border-gray-200">
                    <td class="p-3">{{ employee.staff_id }}</td>
                    <td class="p-3">
                      <img :src=" employee.profile ? `/images/${employee.profile}` : '/images/default_profile.png' "
                        alt="Profile" class="w-12 h-12 rounded-full object-cover"/>
                    </td>
                    <td class="p-3 text-center">{{ employee.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ employee.email }}</td>
                    <td class="p-3 text-center">
                      {{ employee.position ? employee.position.name : 'No position' }}
                    </td>
                    <td class="text-center w-3/12">
                      <button @click="viewEmployee(employee.id)"
                        class="text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-blue-600 hover:bg-blue-400 border-none">
                        <a href="/supervisor/employee/profile/more" class="no-underline text-white">More</a>
                      </button>
                      <!-- <button @click="editEmployee(employee.id)" class="ml-2 text-white px-2 py-1 border-solid border-1 border-indigo-600 rounded-lg bg-gray-900 hover:bg-yellow-400">Update</button> -->
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-600">No Employee found.</td>
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
import axiosInstance from '@/plugins/axios'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      employees_list: [],
      searchQuery: '' // Moved searchQuery into data
    }
  },
  mounted() {
    this.fetchEmployee()
  },
  computed: {
    // Computed property to filter employees based on searchQuery
    filteredEmployees() {
      return this.employees_list.filter(employee =>
        employee.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        employee.staff_id.includes(this.searchQuery)
      )
    }
  },
  methods: {
    async fetchEmployee() {
      try {
        const response = await axiosInstance.get('/employee')
        this.employees_list = response.data
      } catch (error) {
        console.error(error)
      }
    },
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
