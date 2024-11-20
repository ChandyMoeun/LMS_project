<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
            <div class="px-10">
              <div class="flex text-black my-5 " style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
                <router-link to="/supervisor/settings">
                  <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                  </svg>
                </router-link>
                <h1 class="font-bold mr-20 text-3xl px-8 w-2/6 mt-3 hover:text-yellow-500">
                  <b>My Leave Balances</b>
                </h1>
              </div>
              <table class="table border border-gray-200 rounded-lg shadow">
                <thead>
                  <tr>
                    <th class="bg-black text-white px-3">Type</th>
                    <th class="bg-black text-white text-center">Used</th>
                    <th class="bg-black text-white text-center">Available</th>
                    <th class="bg-black text-white text-center">Allowance</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(leave, index) in leaveBalances" :key="index">
                    <td style="overflow-wrap: break-word; word-break: break-word">
                      <div class="d-flex flex-row d-inline-block" style="overflow-wrap: break-word; word-break: break-word">
                        <i class="mr-2 fa fa-circle" :style="{ color: leave.color }" aria-hidden="true" ></i>
                        {{ leave.name }}
                      </div>
                    </td>
                    <td class="text-center text-lowercase">{{ leave.used }}</td>
                    <td class="text-center text-lowercase">{{ leave.available }}</td>
                    <td class="text-center text-lowercase">
                      <span>{{ leave.allowance }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
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
        leaveBalances: [
          {
            name: 'Vacation',
            color: 'rgb(136, 177, 75)',
            used: 1,
            available: 17,
            allowance: 18
          },
          {
            name: 'Sick leave',
            color: 'rgb(239, 86, 45)',
            used: 0,
            available: 60,
            allowance: 60
          },
          {
            name: 'Unpaid leave',
            color: 'rgb(209, 175, 148)',
            used: 0,
            available: 365,
            allowance: 365
          }
        ]
      }
    }
  }
</script>