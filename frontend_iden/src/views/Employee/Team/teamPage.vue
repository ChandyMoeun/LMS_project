<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <EmployeeNavbar/>
          <main class="bg-gray sticky mt-5">
            <div class="mt-10">
            <!-- Employee Management Header -->
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"> <b>Team Management</b> </h1>
              <p class="px-8">Total members: {{ filteredEmployees.length }}</p>
            </div>

            <!-- Search and Filter -->
            <div class="flex justify-between mt-20 mb-7">
              <input v-model="searchQuery" type="text" placeholder="Search..." title="Type of leave or approver Name" class="w-2/6 h-9 px-2 border rounded rounded-lg shadow-md"/>
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
                <tbody>
                  <tr v-for="employee in filteredEmployees" :key="employee.id" class="bg-gray-100 border-b border-gray-200">
                    <td class="p-3">{{ employee.staff_id }}</td>
                    <td class="p-3">
                      <img :src="employee.profile ? `/images/${employee.profile}` : '/images/default_profile.png'"
                          alt="Profile" class="w-12 h-12 rounded-full object-cover" />
                    </td>
                    <td class="p-3 text-center">{{ employee.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ employee.email }}</td>
                    <td class="p-3 text-center">
                      {{ employee.position ? employee.position.name : 'No position' }}
                    </td>
                    <td class="text-center w-3/12">
                      <button @click="viewEmployee(employee.id)"
                              class="text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-blue-600 hover:bg-blue-400 border-none">
                        More
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
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
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      employees_list: [],
      searchQuery: ''
    };
  },
  mounted() {
    this.fetchData(); // Fetch the initial employee data
  },
  computed: {
    // Computed property to filter employees based on searchQuery
    filteredEmployees() {
      return this.employees_list.filter(employee =>
        employee.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        employee.staff_id.includes(this.searchQuery)
      );
    }
  },
  methods: {
    fetchData() {
      this.fetchEmployee();
    },
    viewEmployee(employeeId) {
      // Navigate to the employee profile using Vue Router or a direct URL change
      this.$router.push(`/employee/team/detail/${employeeId}`);
    },
    async fetchEmployee() {
      try {
        const response = await axiosInstance.get('/employee');
        this.employees_list = response.data;
      } catch (error) {
        console.error('Error fetching employee data:', error);
      }
    }
  }
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