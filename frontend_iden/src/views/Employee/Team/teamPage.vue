<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar />
        <main class="p-[50px] mt-5 pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="px-10 mt-10">
            <!-- Employee Management Header -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12">
                <b>Team Management</b>
              </h1>
              <p v-if="teamCount > 0" class="px-8">Total members: {{ teamCount }}</p>
            </div>
            <!-- Search and Filter -->
            <div class="flex justify-between mt-20 mb-7">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search..."
                title="Type of leave or approver Name"
                class="w-2/6 h-9 px-2 border rounded shadow-md"
              />
            </div>
            <!-- Employee Table -->
            <div v-if="filteredTeam.length > 0" class="overflow-x-auto">
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
                <tbody>
                  <tr v-for="member in filteredTeam" :key="member.id" class="bg-gray-100 border-b border-gray-200">
                    <td class="p-3">{{ member.staff_id }}</td>
                    <img
                      :src="member.profile ? `http://127.0.0.1:8000/images/${member.profile}` : '/images/default-profile.jpg'"
                      alt="Profile Picture"
                      class="w-14 h-14 rounded-full"
                    />
                    <td class="p-3 text-center">{{ member.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ member.email }}</td>
                    <td class="p-3 text-center">{{ member.position.name }}</td>
                    <td class="text-center w-3/12">
                      <router-link
                        :to="{ name: 'TeamDetail', params: { id: member.id } }"
                        class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm no-underline"
                      >
                        More
                      </router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div v-else class="flex justify-center items-center min-h-screen">
              <p class="text-xl font-semibold text-gray-600">No team members found.</p>
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
import axiosInstance from '@/plugins/axios' 
import { useAuthStore } from '@/stores/get-team' 

export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      team: [], 
      teamCount: 0, 
      searchQuery: '' 
    }
  },
  computed: {
    filteredTeam() {
      // ==>Filter the team members based on the search query<===
      const query = this.searchQuery.toLowerCase()
      return this.team.filter((member) => {
        return (
          member.full_name.toLowerCase().includes(query) ||
          member.email.toLowerCase().includes(query) ||
          member.position.name.toLowerCase().includes(query) ||
          member.staff_id.toString().includes(query)
        )
      })
    }
  },
  mounted() {
    this.fetchTeamMembers() 
  },
  methods: {
    async fetchTeamMembers() {
      const store = useAuthStore() 
      try {
        // ====>Fetch team members from the backend<===
        const { data } = await axiosInstance.get('/team') 
        this.team = data.teams 
        this.teamCount = data.team_count 
        store.team = data.teams 
        store.teamCount = data.team_count 
      } catch (error) {
        console.error('Error fetching team members:', error)
        this.team = []
        this.teamCount = 0
      }
    }
  }
}
</script>