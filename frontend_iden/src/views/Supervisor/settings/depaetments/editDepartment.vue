<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
            <div class="p-5 mt-5">
                <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                    <router-link to="/Supervisor/Settings/Departments">
                        <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4" /> </svg>
                    </router-link>
                    <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-1/4 px-8">Edit Department</h1>
                </div>

                <div class="container mx-auto px-6 mt-20 py-1 pb-16">
                    <div class="bg-white shadow-md rounded my-6 p-5">
                    <form @submit.prevent="updateDepartment">
                        <!-- Department Name -->
                        <div class="flex flex-col space-y-2 mb-4">
                        <label for="name" class="text-gray-700 select-none font-medium">
                            Department Name
                        </label>
                        <input
                            id="name"
                            v-model="department.name"
                            type="text"
                            placeholder="Enter department name"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        />
                        <span v-if="errors.name" class="text-red-500 text-sm">
                            {{ errors.name }}
                        </span>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center space-x-4 mt-4">
                            <router-link to="/Supervisor/Settings/Departments">
                                <button type="submit" class="bg-yellow-500 text-white font-bold border-none px-3 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors">Update</button>
                            </router-link>
                        </div>
                    </form>
                    </div>
                </div>
            </div> 
        </div>
      </div>
    </SupervisorLayout>
  </template>
  
  <script>
  import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
    components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      department: {
        id: null, // Set the department id if available
        name: '',
      },
      errors: {},
    };
  },
  created() {
    // You would typically load the department data here from an API call
    this.loadDepartmentData();
  },
  methods: {
    loadDepartmentData() {
      // Example function to load department details via an API call
      // You should replace this with actual API interaction
      // axios.get(`/api/department/${this.department.id}`).then(response => {
      //   this.department = response.data;
      // });

      // For now, we use mock data
      this.department.id = 1; // Example ID
      this.department.name = 'Marketing'; // Example name
    },
    updateDepartment() {
      // Clear previous errors
      this.errors = {};

      // Example function to update department data
      // Replace with actual API interaction
      // axios.put(`/api/department/${this.department.id}`, this.department)
      //   .then(response => {
      //     alert('Department updated successfully!');
      //   })
      //   .catch(error => {
      //     if (error.response && error.response.data.errors) {
      //       this.errors = error.response.data.errors;
      //     }
      //   });

      // For now, we simulate the update
      alert('Department updated successfully! (Mocked)');
    },
  },
};
  </script>
  
  
  <style scoped>
  .supervisor{
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
