<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="sticky mt-5">
          <div class="px-10">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/supervisor/settings">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl mt-3 px-8 hover:text-yellow-400 w-1/12"><b>Roles</b></h1>
            </div>
    
            <div class="mt-20">
              <div class="bg-white rounded my-3">
                <table class="text-left w-full border-collapse">
                    <thead class="bg-black text-white">
                        <tr>
                          <th class="py-3 px-6 font-bold text-sm text-grey-dark w-4/12">Role Name</th>
                          <th class="py-3 px-6 text-left font-bold text-sm text-grey-dark">Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in roles" :key="role.id" class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-gray-200"> {{ role.name }} </td>
                            <td class="py-4 px-6 border-b border-gray-200">
                                <span v-for="permission in role.permissions" :key="permission.id" class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">
                                {{ permission.name }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
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
      roles: [
        { id: 1, name: 'Admin', permissions: [{ id: 1, name: 'Create Role' }, { id: 2, name: 'Edit Role' }, { id: 3, name: 'Delete Role' }] },
        { id: 2, name: 'Manager', permissions: [{ id: 1, name: 'Create Role' }, { id: 2, name: 'Edit Role' }] },
        { id: 3, name: 'User', permissions: [{ id: 1, name: 'Create Role' }] },
        // Add more roles as needed...
      ],
    }
  },
}
</script>
  
<style scoped>
  .supervisor {
    display: flex;
    height: 100vh;
    align-items: start;
    width: 100%;
  }
  .sidebar {
    width: 17%;
    height: auto;
  }
  .container-page {
    width: 83%;
  }
  main {
    padding: 50px 50px 0px 50px;
    height: auto;
    width: 100%;
    background-color: #EEEDED;
    margin-bottom: 50px;
  }
</style>