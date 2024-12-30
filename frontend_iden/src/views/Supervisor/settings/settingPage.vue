<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="container mx-auto flex flex-col gap-15 p-4 px-10 justify-evenly">
            <!-- Page Title -->
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
              <h1 class="w-10 font-bold text-3xl mt-3 px-8 hover:text-yellow-400"><b>Setting</b></h1>
            </div>
            <div class="flex flex-wrap justify-start">
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
              <!-- Card for My Profile -->
              <div class="flex h-52 w-2/6 p-3 flex-col">
              <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="mb-2 text-black text-2xl font-bold"> My Profile </h5>
                <p class="mb-3 font-normal text-gray-700"> view my profile account page. </p>
                <a href="/supervisor/settings/myprofile" class="no-underline text-white inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-yellow-400">
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
  </SupervisorLayout>
</template>

<script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  name: 'SettingsPage',
}
</script>