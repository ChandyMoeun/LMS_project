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
                      <p class="mb-3 font-normal text-gray-700">
                        Create, update, and delete departments.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
                    </div>
                  </div>
                  <!-- Card for Leave Types -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Leave Types </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        Define the types of leave employees can take.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
                    </div>
                  </div>
                  <!-- Card for Reset Password -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Reset Password </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        Admins and managers can reset employee passwords.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
                    </div>
                  </div>
                  <!-- Card for Positions -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Position </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        Manage positions and organizational roles.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Card for Permissions -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Permissions </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        Manage user permissions within the system.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
                    </div>
                  </div>
                  <!-- Card for Roles -->
                  <div class="flex h-52 w-2/6 p-3 flex-col">
                    <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                      <h5 class="mb-2 text-black text-2xl font-bold"> Roles </h5>
                      <p class="mb-3 font-normal text-gray-700">
                        Manage user roles in the organization.
                      </p>
                      <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        <a href="/Supervisor/Departments" class="no-underline text-white ">View more</a>
                           <svg
                             class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                             <path
                               stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                           </svg>
                      </div>
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
