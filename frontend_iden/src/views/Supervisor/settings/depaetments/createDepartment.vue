<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="flex-1 mt-5 overflow-x-hidden overflow-y-auto bg-gray-200">
          <div
            style="
              display: flex;
              color: black;
              flex-direction: column;
              border-bottom: solid 1px gray;
            "
          >
              <a href="/Supervisor/Settings/Departments">
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
            </a>
            <h1 class="font-bold text-3xl px-8 mt-2 hover:text-yellow-400 w-2/6">
              <b>New Department</b>
            </h1>
          </div>

          <div class="container mx-auto px-6 py-1 mt-20">
            <div class="bg-white shadow-md rounded my-6 p-5 shadow-lg rounded-lg">
              <form @submit.prevent="submitForm">
                <!-- Department Name -->
                <div class="flex flex-col space-y-2 mb-4">
                  <label for="name" class="text-gray-700 select-none font-medium">
                    Department Name
                  </label>
                  <input
                    id="name"
                    type="text"
                    v-model="department.name"
                    placeholder="Enter department name"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                  <span v-if="errors.name" class="text-red-500 text-sm">
                    {{ errors.name }}
                  </span>
                </div>

                <!-- Manager Selection -->
                <div class="flex flex-col space-y-2 mb-4">
                  <label for="manager_id" class="block text-gray-700 text-sm font-bold mb-2"
                    >Manager</label
                  >
                  <select
                    v-model="department.manager_id"
                    id="manager_id"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                  >
                    <option value="">Select a manager</option>
                    <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                      {{ employee.full_name }}
                    </option>
                  </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center space-x-4 mt-4">
                  <button
                    type="submit"
                    class="bg-yellow-500 border-none text-white font-bold px-4 py-2 rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300"
                  >
                    Add
                  </button>
                </div>
              </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>
  
  <script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      department: {
        name: '',
        manager_id: ''
      },
      employees: [],
      errors: {}
    }
  },
  mounted() {
    // Fetch the list of employees from your API
    this.getEmployees()
  },
  methods: {
    getEmployees() {
      // Replace with your API call
      axios.get('/api/employees').then((response) => {
        this.employees = response.data
      })
    },
    submitForm() {
      // Replace with your actual form submission logic
      axios
        .post('/api/departments', this.department)
        .then((response) => {
          // Handle success (redirect, show success message, etc.)
          this.$router.push('/admin/department')
        })
        .catch((error) => {
          // Handle validation errors
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          }
        })
    }
  }
}
</script>
  
  
  <style scoped>
.supervisor {
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #e5e7eb;
}
.sidebar {
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main {
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #e5e7eb;
  margin-bottom: 50px;
}
</style>