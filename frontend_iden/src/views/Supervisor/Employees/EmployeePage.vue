<template>
  <div>
    <main class="mt-10">
      <!-- Employee Management Header -->
      <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
        <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12"><b>Employee Management</b></h1>
        <p class="px-8">Total Employees: {{ totalEmployees }} </p>
      </div>

      <!-- Search and Filter select position-->
      <div class="flex justify-between mt-20 mb-7">
        <input v-model="searchQuery" @input="filterTable" placeholder="Search employee..." title="Type in an ID or Name" class="w-2/6 py-2 px-2 h-9 border rounded">
        <div class="flex items-center justify-end space-x-2 w-2/5">
          <select v-model="selectedPosition" @change="filterByPosition" class="border rounded p-2 h-9 w-1/3">
            <option value="all">All positions</option>
            <option v-for="position in positions" :key="position.name" :value="position.name">{{ position.name }}</option>
          </select>
          <button class="p-2 flex items-center border-none bg-gray-900 text-white font-bold h-9 px-2 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors" @click="addEmployee">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <a href="/Supervisor/Employee/create" class="no-underline text-white">Add</a>
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
          <tbody>
            <tr v-for="employee in filteredEmployees" :key="employee.staff_id" class="bg-gray-100 border-b border-gray-200">
              <td class="p-3">{{ employee.staff_id }}</td>
              <td class="p-3">
                <img :src="employee.profile ? `/images/${employee.profile}` : '/images/default_profile.png'" alt="Profile" class="w-12 h-12 rounded-full object-cover">
              </td>
              <td class="p-3 text-center">{{ employee.full_name }}</td>
              <td class="p-3 text-blue-600 text-center">{{ employee.email }}</td>
              <td class="p-3 text-center">{{ employee.position ? employee.position.name : 'No position' }}</td>
              <td class="text-center w-3/12">
                <button @click="viewEmployee(employee.id)" class="text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-blue-600 hover:bg-blue-400 border-none">More</button>
                <!-- <button @click="editEmployee(employee.id)" class="ml-2 text-white px-2 py-1 border-solid border-1 border-indigo-600 rounded-lg bg-gray-900 hover:bg-yellow-400">Update</button> -->
                <button @click="editEmployee(employee.id)" class="ml-2 text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-gray-900 hover:bg-yellow-500"><a href="/Supervisor/Employee/Update" class="no-underline text-white">Update</a></button>
                <button @click="deleteEmployee(employee.id)" class="ml-2 text-white px-2 py-1 border-solid border-0 border-indigo-600 rounded-lg bg-red-600 hover:bg-red-400 border-none">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: '',
      selectedPosition: 'all',
      totalEmployees: 1, // Assuming you're fetching this value from the backend
      positions: [
        { name: 'Manager' },
        { name: 'Developer' },
        { name: 'Designer' }
        // ...other positions
      ],
      employees: [
        {
          staff_id: '001',
          profile: null, // assuming null means no profile
          full_name: 'John Doe',
          email: 'john.doe@example.com',
          position: { name: 'Developer' }
        },
        // ...other employees
      ],
      filteredEmployees: []
    };
  },
  mounted() {
    this.filteredEmployees = this.employees; // Initialize filteredEmployees
  },
  methods: {
    filterTable() {
      const query = this.searchQuery.toUpperCase();
      this.filteredEmployees = this.employees.filter(employee => {
        return employee.staff_id.toUpperCase().includes(query) || employee.full_name.toUpperCase().includes(query);
      });
    },
    filterByPosition() {
      if (this.selectedPosition === 'all') {
        this.filteredEmployees = this.employees;
      } else {
        this.filteredEmployees = this.employees.filter(employee => {
          return employee.position && employee.position.name === this.selectedPosition;
        });
      }
    },
    addEmployee() {
      // Logic to navigate to the Add Employee page or open a form
      this.$router.push({ name: 'EmployeeCreate' });
    },
    viewEmployee(id) {
      // Logic to view the employee details
      this.$router.push({ name: 'EmployeeShow', params: { id } });
    },
    editEmployee(id) {
      // Logic to edit employee
      this.$router.push({ name: 'EmployeeEdit', params: { id } });
    },
    deleteEmployee(id) {
      // Logic to delete employee
      if (confirm('Are you sure you want to delete this employee?')) {
        // Perform delete action here, likely an API call
        this.employees = this.employees.filter(employee => employee.id !== id);
        this.filterTable(); // Update table after deletion
      }
    }
  }
};
</script>

<style scoped>
/* Add custom styles if necessary */
</style>
