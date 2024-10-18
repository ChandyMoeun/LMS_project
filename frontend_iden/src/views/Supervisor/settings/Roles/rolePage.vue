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
            <router-link to="/admin/mail">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </router-link>
            <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-400 w-1/12"><b>Roles</b></h1>
            </div>
    
            <div class="container mx-auto mt-20 px-6 py-2">
            <div class="text-right">
                <button
                @click="createRole"
                class="bg-gray-900 border-none text-white font-bold px-3 mr-8 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">
                New Role
                </button>
            </div>
    
            <div class="bg-white rounded my-3">
                <table class="text-left w-full border-collapse">
                    <thead class="bg-black text-white">
                        <tr>
                        <th class="py-3 px-6 font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Role Name</th>
                        <th class="py-3 px-6 text-center font-bold text-sm text-grey-dark border-b border-grey-light">Permissions</th>
                        <th class="py-3 px-6 text-center font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr v-for="role in roles" :key="role.id" class="hover:bg-grey-lighter"> -->
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light"> fffffffff
                                 <!-- {{ role.name }}  -->
                                </td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <!-- <span v-for="permission in role.permissions" :key="permission.id" class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full"> -->
                                <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">
                                <!-- {{ permission.name }} -->ccccccccccc
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">
                                hhhhhhh
                                </span>
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light text-right">
                                <button
                                @click="editRole(role.id)"
                                class="text-white font-bold py-1 px-3 border rounded text-xs bg-black hover:bg-yellow-400">
                                Edit
                                </button>
            
                                <button
                                @click="deleteRole(role.id)"
                                class="text-white font-bold py-1 border-none px-2 ml-3 rounded text-xs bg-red-500 hover:bg-red-400">
                                Delete
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
  </SupervisorLayout>
</template>
  
  <script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      roles: [], // Array of roles fetched from the API
      canCreateRole: false, // Permission flags
      canEditRole: false,
      canDeleteRole: false
    }
  },
  mounted() {
    this.loadRoles()
    this.checkPermissions()
  },
  methods: {
    loadRoles() {
      // Fetch roles and permissions from API
      // Example: axios.get('/api/roles').then(response => { this.roles = response.data; });
      console.log('Loading roles...')
    },
    checkPermissions() {
      // Check user's permission capabilities
      // Example: axios.get('/api/user-permissions').then(response => {
      //   this.canCreateRole = response.data.create;
      //   this.canEditRole = response.data.edit;
      //   this.canDeleteRole = response.data.delete;
      // });
      console.log('Checking permissions...')
    },
    createRole() {
      // Redirect to the role creation page
      this.$router.push({ name: 'RoleCreate' })
    },
    editRole(roleId) {
      // Redirect to the role edit page
      this.$router.push({ name: 'RoleEdit', params: { id: roleId } })
    },
    deleteRole(roleId) {
      // Confirm and delete the role via API
      // Example: axios.delete(`/api/roles/${roleId}`).then(() => this.loadRoles());
      console.log('Deleting role:', roleId)
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