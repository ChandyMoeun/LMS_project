<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky mt-5">
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
            <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-1/12"><b>Team</b></h1>
            <p class="px-8">Total Employees: {{ totalEmployees }} </p>
            </div>
    
            <!-- Search and Filter select position-->
            <div class="flex justify-between mt-20 mb-3">
                <input v-model="searchQuery" @input="filterTable" placeholder="Search employee..." title="Type in an ID or Name" class="w-2/6 ml-8 py-2 px-2 h-9 border rounded">
                <div class="flex items-center justify-end space-x-2 w-2/5">
                    <select v-model="selectedPosition" @change="filterByPosition" class="border mr-8 rounded p-2 h-9 w-1/3">
                    <option value="all">All positions</option>
                    <option v-for="position in positions" :key="position.name" :value="position.name">{{ position.name }}</option>
                    </select>
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
                <tbody>
                <tr v-for="employee in employees_list" :key="employee.id" class="bg-gray-100 border-b border-gray-200">
                    <td class="p-3">{{ employee.staff_id }}</td>
                    <td class="p-3">
                    <img :src="employee.profile ? `/images/${employee.profile}` : '/images/default_profile.png'" alt="Profile" class="w-12 h-12 rounded-full object-cover">
                    </td>
                    <td class="p-3 text-center">{{ employee.full_name }}</td>
                    <td class="p-3 text-blue-600 text-center">{{ employee.email }}</td>
                    <td class="p-3 text-center">{{ employee.position ? employee.position.name : 'No position' }}</td>
                    <td class="text-center w-3/12">
                    <button @click="viewEmployee(employee.id)" class="text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-blue-600 hover:bg-blue-400 border-none"><a href="#" class="no-underline text-white">More</a></button>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
          </main>
        </div>
      </div>
    </EmployeeLayout>
  </template>
  
  <script>
    import axiosInstance from '@/plugins/axios';
    import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
    import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
    export default {
    components: {EmployeeSidebar, WebHeaderMenu},
    data() {
      return {
        employees_list: [],
  
      };
    },
    mounted() {
      this.fatchData();// Initialize filteredEmployees
    },
    methods: {
      fatchData(){
        this.fetchEmployee();
      },
  
      // filterTable() {
      //   const query = this.searchQuery.toUpperCase();
      //   this.filteredEmployees = this.employees.filter(employee => {
      //     return employee.staff_id.toUpperCase().includes(query) || employee.full_name.toUpperCase().includes(query);
      //   });
      // },
      // filterByPosition() {
      //   if (this.selectedPosition === 'all') {
      //     this.filteredEmployees = this.employees;
      //   } else {
      //     this.filteredEmployees = this.employees.filter(employee => {
      //       return employee.position && employee.position.name === this.selectedPosition;
      //     });
      //   }
      // },
   
  
      //intergation data
  
      async fetchEmployee() {
        try {
          const response = await axiosInstance.get('/employee');
          this.employees_list = response.data
        } catch (error) {
          console.error(error);
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