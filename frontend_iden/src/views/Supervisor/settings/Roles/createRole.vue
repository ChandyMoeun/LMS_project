<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky mt-5">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/Supervisor/Settings/Role">
                    <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </router-link>
                <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-400 w-2/12"><b>New Role</b></h1> 
            </div>
            <div class="container mx-auto px-6 py-1 mt-20">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form @submit.prevent="submitForm">
                        <div class="flex flex-col space-y-2 m-5">
                            <label for="role_name" class="text-gray-700 select-none font-medium">Role Name</label>
                            <input
                            id="role_name"
                            v-model="role.name"
                            type="text"
                            name="name"
                            placeholder="Enter role"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                            <div v-if="errors.name" class="text-red-500 text-xs mt-2">{{ errors.name }}</div>
                        </div>
            
                        <strong><h1 class="text-xl text-center mt-10 my-4 text-black">Select Permissions</h1></strong>
                        <div class="grid grid-cols-3 gap-4 m-10">
                            <div v-for="permission in permissions" :key="permission.id" class="flex flex-col justify-center">
                            <div class="flex flex-col">
                                <label class="inline-flex items-center mt-3">
                                <input
                                    type="checkbox"
                                    class="form-checkbox h-5 w-5 text-blue-600"
                                    v-model="role.permissions"
                                    :value="permission.id"
                                />
                                <span class="ml-2 text-gray-700">{{ permission.name }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
        
                    <div class="text-center mt-5">
                        <button
                        type="submit"
                        class="bg-yellow-500 border-none text-white font-bold px-3 py-1 rounded focus:outline-none shadow hover:bg-black transition-colors"
                        >Submit</button>
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
import axios from 'axios'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      role: {
        name: '',
        permissions: []
      },
      permissions: [], // List of permissions
      errors: {} // To capture form errors
    }
  },
  created() {
    this.fetchPermissions()
  },
  methods: {
    // Fetch the list of permissions
    async fetchPermissions() {
      try {
        const response = await axios.get('/api/permissions') // Replace with your API endpoint
        this.permissions = response.data
      } catch (error) {
        console.error('Error fetching permissions:', error)
      }
    },
    // Handle form submission
    async submitForm() {
      try {
        await axios.post('/api/roles', this.role) // Replace with your API endpoint
        alert('Role added successfully!')
        // Redirect or reset form
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors // Capture validation errors
        } else {
          console.error('Error adding role:', error)
        }
      }
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