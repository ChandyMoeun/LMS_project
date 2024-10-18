<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky mt-10 ">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/Supervisor/Settings">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4" />
                    </svg>
                </router-link>
                <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 px-8 w-1/6"><b>Permission</b></h1>
                </div>
        
                <div class="container mx-auto mt-20 px-6 py-2">
                <div class="text-right">
                    <button @click="createPermission" class="bg-gray-900 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">
                    New Permission
                    </button>
                </div>
        
                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead class="bg-black ">
                            <tr>
                            <th class="py-3 px-6 bg-grey-lightest font-bold text-sm text-white border-b border-grey-light">Permission Name</th>
                            <th class="py-3 px-6 bg-grey-lightest font-bold text-sm text-white border-b border-grey-light text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr v-for="permission in permissions" :key="permission.id" class="hover:bg-grey-lighter">
                                <tr :key="permission.id" class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light"> permission
                                    {{ permission.name }}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light text-right">
                                    <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                
                                    
                                </td>
                            </tr> -->
                            <tr>
                                <td class="py-4 px-6 border-b border-grey-light">Role access</td>
                                <td class="py-4 px-3 border-b text-right">
                                    <a href="#" class="text-grey-lighter font-bold py-1 no-underline px-2 text-xs text-blue-400">Edit</a>
                                    <a href="#" class=" font-bold py-1 px-2 no-underline text-xs text-red-400 ">delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
      permissions: [], // List of permissions fetched from API
      canCreatePermission: false, // Permission flags from API or session data
      canEditPermission: false,
      canDeletePermission: false
    }
  },
  mounted() {
    this.loadPermissions()
    this.checkPermissions()
  },
  methods: {
    loadPermissions() {
      // Fetch permissions data from API
      // Example: axios.get('/api/permissions').then(response => { this.permissions = response.data; });
    },
    checkPermissions() {
      // Fetch user permission capabilities from API or local state
      // Example: axios.get('/api/user-permissions').then(response => {
      //   this.canCreatePermission = response.data.create;
      //   this.canEditPermission = response.data.edit;
      //   this.canDeletePermission = response.data.delete;
      // });
    },
    createPermission() {
      // Redirect to permission creation page
      this.$router.push({ name: 'PermissionCreate' })
    },
    editPermission(permissionId) {
      // Redirect to the permission edit page
      this.$router.push({ name: 'PermissionEdit', params: { id: permissionId } })
    },
    deletePermission(permissionId) {
      // Make an API call to delete the permission
      // Example: axios.delete(`/api/permissions/${permissionId}`).then(() => this.loadPermissions());
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
  