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
        <a href="/Supervisor/Settings/Positions">
          <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </a>
        <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-500 w-3/12"><b>New Position</b></h1>
      </div>

      <div class="container mx-auto px-6 py-1 pb-16 mt-20">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form @submit.prevent="submitForm">
            <!-- Position Name -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="name" class="text-gray-700 select-none font-medium">Position Name</label>
              <input v-model="form.name" id="name" type="text" name="name" placeholder="Enter position name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name[0] }}</span>
            </div>

            <!-- Department -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="department_id" class="text-gray-700 select-none font-medium">Department</label>
              <select v-model="form.department_id" id="department_id" name="department_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option value="">Select Department</option>
                <option v-for="department in departments" :key="department.id" :value="department.id">
                  {{ department.name }}
                </option>
              </select>
              <span v-if="errors.department_id" class="text-red-500 text-sm">{{ errors.department_id[0] }}</span>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center space-x-4 mt-4">
              <button type="submit" class="bg-yellow-500 text-white border-none font-bold px-4 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors">
                Add
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
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      form: {
        name: '',
        department_id: ''
      },
      errors: {},
      departments: [] // Assume you fetch the list of departments
    };
  },
  mounted() {
    this.fetchDepartments(); // Load departments on mount
  },
  methods: {
    fetchDepartments() {
      axios.get('/api/departments') // Replace with your actual API endpoint
        .then(response => {
          this.departments = response.data;
        })
        .catch(error => {
          console.log("Error fetching departments", error);
        });
    },
    submitForm() {
      axios.post('/api/positions', this.form)
        .then(response => {
          alert("Position added successfully");
          this.$router.push('/admin/position'); // Redirect after success
        })
        .catch(error => {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
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