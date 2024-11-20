<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main class="sticky mt-5">
          <div class="px-10 mt-10">
            <!-- Employee Management Header -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12">
                <b>Team Management</b>
              </h1>
              <p v-if="teamCount > 0" class="px-8">Total members: {{ teamCount }}</p>
            </div>
            <!-- Search and Filter -->
            <div class="flex justify-between mt-20 mb-7">
              <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or approver Name" class="w-2/6 h-9 px-2 border rounded shadow-md" />
            </div>
            <!-- Employee Table -->
            <div v-if="team.length > 0" class="overflow-x-auto">
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
                <tbody >
                  <tr v-for="member in team" :key="member.id" class="bg-gray-100 border-b border-gray-200" >
                    <td class="p-3">{{ member.staff_id }}</td>
                    <img :src=" member.profile && member.profile ? `http://127.0.0.1:8000/images/${member.profile}` : '/images/default-profile.jpg' "
                      alt="Profile Picture" class="w-14 h-14 rounded-full" />
                    <td class="p-3 text-center">{{ member.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ member.email }}</td>
                    <td class="p-3 text-center">{{ member.position.name }}</td>
                    <td class="text-center w-3/12">
                      <router-link :to="{ name: 'TeamDetail', params: { id: member.id } }"
                        class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm no-underline">
                        More
                      </router-link>
                    </td>
                  </tr>
                </tbody>
                <!-- Loading State -->
              </table>
            </div>
            <div v-else class="flex justify-center items-center min-h-screen">
              <p class="text-xl font-semibold text-gray-600">Loading employee data...</p>
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
import axiosInstance from '@/plugins/axios' // Adjust the path if needed
import { useAuthStore } from '@/stores/get-team' // Pinia store

export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      team: [], // Local state to store team members
      teamCount: 0 // Local state to store team count
    }
  },
  mounted() {
    this.fetchTeamMembers() // Call the fetch method when the component is mounted
  },
  methods: {
    async fetchTeamMembers() {
      const store = useAuthStore() // Access the store
      try {
        // Fetch team members from the backend
        const { data } = await axiosInstance.get('/team') // Replace with your API endpoint

        // Update local state and Pinia store
        this.team = data.teams // Update component's team
        this.teamCount = data.team_count // Update component's team count

        store.team = data.teams // Optionally, store data in Pinia if needed globally
        store.teamCount = data.team_count // Store the count in Pinia

        console.log('Fetched team members:', this.team) // Log the fetched data
      } catch (error) {
        console.error('Error fetching team members:', error)
        // Reset data on error
        this.team = []
        this.teamCount = 0
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