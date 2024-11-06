<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar/>
        <main class="bg-gray sticky top-0">
          <div class="mt-10 pb-20">
            <div class="container">
              <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
                <router-link to="/employee/team">
                  <svg class="w-6 h-6 mb-3 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                  </svg>
                </router-link>
                <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12"><b>{{ employee.full_name }} Profile</b></h1>
              </div>
              <div v-if="employee" class="container mt-20 mx-auto p-6">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
                  <div class="d-flex justify-content-center pt-5">
                    <!-- <img :src="employee.profile ? getProfileImage(employee.profile) : getDefaultProfile()" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;"> -->
                  </div>
                  <div class="d-flex justify-around gap-4 p-6 mt-3">
                    <!-- Left column -->
                    <!-- <div>
                      <p><strong>Staff ID:</strong> {{ employee.staff_id || '?' }}</p>
                      <p><strong>Name:</strong> {{ employee.full_name }}</p>
                      <p><strong>Gender:</strong> {{ employee.gender }}</p>
                      <p><strong>Date of Birth:</strong> {{ employee.dob }}</p>
                      <p><strong>Position:</strong> {{ employee.position.name }}</p>
                      <p><strong>Department:</strong> {{ employee.department.name }}</p>
                      <p><strong>Roles:</strong>
                        <span v-for="(role, index) in employee.roles" :key="index">
                          {{ role.name }}<span v-if="index < employee.roles.length - 1">, </span>
                        </span>
                      </p>
                    </div> -->

                    <!-- Right column -->
                    <!-- <div>
                      <p><strong>Date Joined:</strong> {{ employee.joined_date }}</p>
                      <p><strong>Confirm Date:</strong> {{ employee.entitled_date }}</p>
                      <p><strong>Phone:</strong> {{ employee.phone || 'N/A' }}</p>
                      <p><strong>Telegram Number:</strong> {{ employee.telegram_number || 'N/A' }}</p>
                      <p><strong>Email:</strong> {{ employee.email }}</p>
                      <p><strong>Line Manager:</strong> {{ employee.manager ? employee.manager.full_name : 'No manager' }}</p>
                      <p><strong>Subline:</strong> XXX</p>
                    </div> -->
                    {{ employee }}
                  </div>
                </div>
              </div>
              <div v-else>
                <p>Loading employee data...</p>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue';
export default {
  components: {EmployeeSidebar, EmployeeNavbar},
  data() {
    return {
      // employee: {
      //   staff_id: '',
      //   full_name: '',
      //   gender: '',
      //   dob: '',
      //   position: { name: '' },
      //   department: { name: '' },
      //   roles: [],
      //   profile: '',
      //   joined_date: '',
      //   entitled_date: '',
      //   email: '',
      //   manager: { full_name: '' },
      // },
      employee: [],
      employee_id: this.$route.params.id,
    };
  },
  methods: {
    // Returns profile image URL if available
    getProfileImage(profile) {
      return `/images/${profile}`;
    },
    // Fallback to default profile image
    getDefaultProfile() {
      return '/images/default_profile.png';
    },
    async fetchEmployee() {
      try {
        const response = await axiosInstance.get(`/employee/${this.employee_id}`);
        this.employee = response.data; // Assign the response to the employee object
      } catch (error) {
        console.error('Error fetching employee data:', error);
      }
    },
    fetchData() {
      this.fetchEmployee(); // Call fetchEmployee method to get data
    }
  },
  mounted() {
    // Simulated API call to fetch employee data
    // In a real app, replace this with an actual API request, e.g., axios.get('/api/employee/{id}')
    this.fetchData();
  },
};
</script>


<style scoped>
.employee{
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