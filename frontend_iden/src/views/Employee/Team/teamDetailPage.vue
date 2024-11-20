<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page ">
        <EmployeeNavbar />
        <main class="sticky top-0">
          <div class="mt-10 px-10 pb-20">
            <div class="container">
              <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
                <router-link to="/employee/team">
                  <svg class="w-6 h-6 mb-3 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                  </svg>
                </router-link>
                <h1 v-if="member" class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12">
                  <b>{{ member.full_name }} Profile</b>
                </h1>
              </div>
              <div v-if="member" class="container mt-10 mx-auto p-6">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
                  <div class="d-flex justify-content-center pt-5">
                    <img :src=" member.profile ? `http://127.0.0.1:8000/images/${member.profile}` : '/images/default-profile.jpg' "
                    alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover" />
                  </div>
                  <div class="d-flex justify-around gap-4">
                    <!-- Left column -->
                    <div>
                      <p><strong>Staff ID:</strong> {{ member.staff_id || '?' }}</p>
                      <p><strong>Name:</strong> {{ member.full_name }}</p>
                      <p><strong>Gender:</strong> {{ member.gender }}</p>
                      <p><strong>Date of Birth:</strong> {{ member.dob }}</p>
                      <p><strong>Position:</strong> {{ member.position.name }}</p>
                      <p><strong>Department:</strong> {{ member.department.name }}</p>
                    </div>
                    <!-- Right column -->
                    <div>
                      <p><strong>Date Joined:</strong> {{ member.joined_date }}</p>
                      <p><strong>Confirm Date:</strong> {{ member.entitled_date }}</p>
                      <p><strong>Phone:</strong> {{ member.phone || 'N/A' }}</p>
                      <p><strong>Telegram Number:</strong> {{ member.telegram_number || 'N/A' }}</p>
                      <p><strong>Email:</strong> {{ member.email }}</p>
                      <p><strong>Line Manager:</strong> {{ member.manager ? member.manager.full_name : 'No manager' }}</p>
                    </div>  {{ employee }}
                  </div>
                </div>
              </div>
              <!-- Loading State -->
              <div v-else class="flex justify-center items-center min-h-screen">
                <p class="text-xl font-semibold text-gray-600">Loading employee data...</p>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script>
import axiosInstance from '@/plugins/axios' // Adjust path if needed
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      member: null // To hold the fetched member details
    }
  },
  async created() {
    const memberId = this.$route.params.id // Get the member ID from the route parameters
    await this.fetchMemberDetails(memberId) // Fetch member details based on the ID
  },
  methods: {
    async fetchMemberDetails(id) {
      try {
        // Fetch the team member details from the backend API using the ID
        const { data } = await axiosInstance.get(`/team/${id}`)
        this.member = data.team_member // Store the fetched team member's data in the member variable
      } catch (error) {
        console.error('Error fetching team member details:', error)
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