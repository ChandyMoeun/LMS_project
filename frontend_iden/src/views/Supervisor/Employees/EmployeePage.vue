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
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12">
                <b>Team Management</b>
              </h1>
              <p class="px-8">Total members: {{ teamCount }}</p>
            </div>
            
            <div class="flex justify-between mt-20 mb-7">
              <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or approver Name" class="w-2/6 h-9 px-2 border rounded rounded-lg shadow-md" />
              <div class="flex items-center justify-end space-x-2 w-2/5">
                <button
                  class="p-2 flex items-center border-none bg-gray-900 text-white font-bold h-9 px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors"
                  @click="addEmployee" >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                  </svg>
                  <a href="/supervisor/employee/create" class="no-underline text-white">Add</a>
                </button>
              </div>
            </div>

            <!-- Employee Table -->
            <div class="overflow-x-auto">
              <table v-if="authStore.member" class="w-full bg-white shadow-md rounded">
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
                <tbody>
                  <tr v-for="(member, index) in authStore.member" :key="index" class="bg-gray-100 border-b border-gray-200" >
                    <td class="p-3">{{ member.staff_id }}</td>
                    <td class="p-3">
                      <img :src=" member.profile && member.profile   ? `http://127.0.0.1:8000/images/${member.profile}` : '/images/default-profile.jpg' "
                        alt="Profile Picture" class="w-14 h-14 rounded-full" />
                    </td>
                    <td class="p-3 text-center">{{ member.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ member.email }}</td>
                    <td class="p-3 text-center">{{ member.position.name }}</td>
                    <td class="text-center w-3/12">
                      <router-link :to="{ name: 'EmployeeProfile', params: { id: member.id } }"
                        class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm no-underline">
                        More
                      </router-link>
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
// import axiosInstance from '@/plugins/axios'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { useAuthStore } from '@/stores/get-member'

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
      return this.employees_list.filter(
        (employee) =>
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
    }
  },
  setup() {
    const authStore = useAuthStore()
    // Fetch member data when component is mounted
    // onMounted(() => {
    //   authStore.fetchMember() // Call the fetchMember method from the store
    // })
    return { authStore, teamCount: authStore.teamCount }
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