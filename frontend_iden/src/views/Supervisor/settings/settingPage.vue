<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
              <div class="container mx-auto flex flex-col gap-15 p-4 px-1 justify-evenly">
                <!-- Page Title -->
                <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                  <h1 class="w-10 font-bold text-3xl mt-5 hover:text-yellow-400">
                    <b>Setting</b>
                  </h1>
                </div>
                <div class="flex flex-wrap justify-center">
                  <!-- Card for Departments -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Departments </h5>
                      <p class="mb-3 font-normal text-gray-700"> View departments. </p>
                      <a href="/supervisor/settings/departments" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <!-- Card for leave balance -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Leave Balance </h5>
                      <p class="mb-3 font-normal text-gray-700"> View my leave balance in the organization. </p>
                      <a href="/supervisor/settings/leavebalance" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <!-- Card for Leave Types -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Leave Types </h5>
                      <p class="mb-3 font-normal text-gray-700"> View the types of leave employees can take. </p>
                      <a href="/supervisor/settings/leavetype" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <!-- Card for Reset Password -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Reset Password </h5>
                      <p class="mb-3 font-normal text-gray-700"> I can reset my account password by my salf. </p>
                      <a href="/supervisor/settings/resetpassword" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <!-- Card for Positions -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Position </h5>
                      <p class="mb-3 font-normal text-gray-700"> View positions and organizational roles. </p>
                      <a href="/supervisor/settings/positions" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                          View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  
                  <!-- Card for Permissions -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Permissions </h5>
                      <p class="mb-3 font-normal text-gray-700"> View user permissions within the system. </p>
                      <a href="/supervisor/settings/permissions" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg
                          class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path
                          stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Roles </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        View user roles in the organization.
                      </p>
                      <a href="/Supervisor/settings/role" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg
                          class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path
                          stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
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
  name: 'SettingsPage',
  data() {
    return {
      // Your data here
      // Example:
      // items: []
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