<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0 mt-10">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/Supervisor/Settings/Permissions">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </router-link>
                <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-400 w-3/12"><b>Add Permission</b></h1>
            </div>
    
            <div class="container px-6 py-1">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form @submit.prevent="submitForm">
                        <div class="flex flex-col space-y-2">
                            <label for="permission_name" class="text-gray-700 select-none font-medium">Permission Name</label>
                            <input
                            id="permission_name"
                            type="text"
                            v-model="permissionName"
                            placeholder="Enter permission"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="text-center mt-16">
                            <button
                            type="submit"
                            class="bg-yellow-500 text-white font-bold px-3 py-1 border-none rounded focus:outline-none shadow hover:bg-black transition-colors">
                            Submit
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
      permissionName: '' // Bound to the form input
    }
  },
  methods: {
    // Method to handle form submission
    submitForm() {
      // Make an API call to store the permission
      // Example: axios.post('/api/permissions', { name: this.permissionName })
      // .then(response => { /* Handle success, maybe redirect */ })
      // .catch(error => { /* Handle error */ });

      console.log('Submitting permission:', this.permissionName)
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
  