<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px] mt-10">
          <div class="px-10">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/supervisor/settings">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 px-8 w-1/6"><b>Permissions</b></h1>
            </div>
            <div class="mt-20">
              <div class="bg-white shadow-md rounded my-3">
                <table class="text-left w-full">
                  <thead class="bg-black ">
                    <tr>
                      <th class="py-3 px-6 font-bold text-sm text-white ">Permission Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="permission in permissions" :key="permission.id" class="hover:bg-grey-lighter">
                      <td class="py-3 px-6 border-b border-grey-100"> permission
                        {{ permission.name }}
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
      permissions: [
        { id: 1, name: 'Create Permission' },
        { id: 2, name: 'Edit Permission' },
        { id: 3, name: 'Delete Permission' },
        { id: 4, name: 'View Permission' },
      ], 
    }
  },
}
</script>