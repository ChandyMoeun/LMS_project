<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <EmployeeNavbar />
          <main>
            <div class="container mx-auto flex flex-col gap-15 p-4 px-10 justify-evenly">
              <!-- Page Title -->
              <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <h1 class="w-10 font-bold text-3xl mt-5 hover:text-yellow-400">
                  <b>Setting</b>
                </h1>
              </div>
              <div class="flex flex-wrap justify-between">
                <!-- Card for Leave balances -->
                <div class="flex h-52 w-2/6 p-3 flex-col">
                  <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-black text-2xl font-bold"> Leave Balances </h5>
                    <p class="mb-3 font-normal text-gray-700"> Define the balances of leave that I can take. </p>
                    <a href="/employee/settings/balances" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                      View more
                      <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                      </svg>
                    </a>
                  </div>
                </div>
                <!-- Card for My Profile -->
                <div class="flex h-52 w-2/6 p-3 flex-col">
                  <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-black text-2xl font-bold"> My Profile </h5>
                    <p class="mb-3 font-normal text-gray-700"> view my profile account page. </p>
                    <a href="/employee/settings/profile" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
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
                      <a href="/employee/settings/resetpassword" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
                        View more
                        <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                      </a>
                    </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </EmployeeLayout>
  </template>
  
  <script>
  import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
  import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
  export default {
    components: { EmployeeSidebar, EmployeeNavbar },
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
.employee {
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