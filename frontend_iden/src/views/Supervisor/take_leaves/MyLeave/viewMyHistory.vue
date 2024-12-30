<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-10 pb-20 px-10">
            <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/supervisor/requestleave/myleaved">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold mr-20 text-3xl px-8 w-4/12 mt-3 hover:text-yellow-400">
                <b>My Leave History</b>
              </h1>
            </div>
            <!-- Leave Request Details -->
            <div class="max-w-4xl mx-auto mt-20 p-5 bg-gray-100 rounded-lg shadow-md">
              <!-- Left Column: Request Details -->
              <div class="grid grid-cols-2 gap-8">
                <div>
                  <div class="mb-4">
                    <span class="font-semibold">Date:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | Full Day</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested at:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | 10:23 AM</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Part of day:</span>
                    <p class="mt-1">Full Day</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested by:</span>
                    <p class="mt-1 flex items-center">
                      <img class="h-6 w-6 rounded-full mr-2" src="https://via.placeholder.com/40" alt="Profile"/> 
                      Kris Wang </p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Reason:</span>
                    <p disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">Dear Mr.Cat, I would like to ask for permission to take leave one day. Because I'm feeling sick.</p>
                  </div>
                </div>
                <!-- Right Column: Approval Details -->
                <div>
                  <div class="mb-4">
                    <span class="font-semibold">Type of leave:</span>
                    <p class="mt-1">Sick leave</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Status:</span>
                    <p class="mt-1">Approved</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Approved at:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | 10:30 AM</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Approval by:</span>
                    <p class="mt-1 flex items-center">
                      <img class="h-6 w-6 rounded-full mr-2" src="https://via.placeholder.com/40" alt="Profile"/>
                      Cat
                    </p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Comment:</span>
                    <p disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">Okay.</p>
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
  }
</script>