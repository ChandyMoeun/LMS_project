<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky top-0">
            <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="mt-5" style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray; ">
          <router-link to="/Supervisor/Settings/Positions">
            <svg
              class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 5H1m0 0 4 4M1 5l4-4"
              />
            </svg>
          </router-link>
          <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-400 w-1/5">
            <b>Edit Position</b>
          </h1>
        </div>
        <div class="container mx-auto px-6 py-1 mt-10 px-9">
          <div class="bg-white shadow-md rounded my-6 p-5">
            <form @submit.prevent="updatePosition">
              <!-- Position Name -->
              <div class="flex flex-col space-y-2 mb-4">
                <label for="name" class="text-gray-700 select-none font-medium"
                  >Position Name</label
                >
                <input
                  id="name"
                  v-model="formData.name"
                  type="text"
                  placeholder="Enter position name"
                  class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                />
                <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</span>
              </div>
  
              <!-- Department -->
              <div class="flex flex-col space-y-2 mb-4">
                <label for="department_id" class="text-gray-700 select-none font-medium"
                  >Department</label
                >
                <select
                  id="department_id"
                  v-model="formData.department_id"
                  class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                >
                  <option value="">Select Department</option>
                  <option
                    v-for="department in departments"
                    :key="department.id"
                    :value="department.id"
                  >
                    {{ department.name }}
                  </option>
                </select>
                <span v-if="errors.department_id" class="text-red-500 text-sm">{{ errors.department_id }}</span>
              </div>
  
              <!-- Submit Button -->
              <div class="flex justify-center space-x-4 mt-4">
                <button
                  type="submit"
                  class="bg-yellow-500 text-white font-bold px-3 border-none py-2 rounded focus:outline-none shadow hover:bg-black transition-colors"
                >
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
          </main>
        </div>
      </div>
    </SupervisorLayout>
  </template>
  
  <script>
  import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  import axios from 'axios';
  export default {
    components: { SupervisorSidebar, WebHeaderMenu },
    data() {
      return {
        formData: {
          name: '', // pre-populated with the position name
          department_id: '', // pre-populated with the department id
        },
        errors: {},
        departments: [], // fetched from API
      };
    },
    created() {
      this.fetchDepartments();
      this.fetchPosition(); // Fetch the position to pre-populate the form
    },
    methods: {
      async fetchDepartments() {
        try {
          const response = await axios.get('/api/departments'); // Assuming an API endpoint for fetching departments
          this.departments = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      async fetchPosition() {
        const positionId = this.$route.params.id; // Assuming route params contains position id
        try {
          const response = await axios.get(`/api/positions/${positionId}`);
          this.formData.name = response.data.name;
          this.formData.department_id = response.data.department_id;
        } catch (error) {
          console.error(error);
        }
      },
      async updatePosition() {
        const positionId = this.$route.params.id;
        try {
          await axios.put(`/api/positions/${positionId}`, this.formData);
          // Redirect or give a success message
          this.$router.push('/admin/position');
        } catch (error) {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors; // Show validation errors
          }
        }
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