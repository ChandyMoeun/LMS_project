<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-5 px-10">
            <!-- Header with Back button and Title -->
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/supervisor/settings">
                <svg class="w-6 h-6 text-gray-900 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl mt-2 px-8 hover:text-yellow-400 w-3/12"><b>Leave Types</b></h1>
            </div>

            <!-- Leave Types List -->
            <div class="container mt-20 mx-auto px-6">
              <h6 class="text-center text-2xl text-gray-900 font-bold mb-6">All Leave Types</h6>
              <table class="w-full bg-white shadow-md rounded-lg">
                <thead class="bg-black text-white text-xs uppercase">
                  <tr>
                    <th class="px-3 py-3 ">Leave Type</th>
                    <th class="px-3 py-3 text-center">Requires Attachment</th>
                    <th class="px-3 py-3 text-center">Auto Increase Entitlement</th>
                    <th class="px-3 py-3 text-center">Increase Rate</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y border-gray-200"> 
                  <tr v-for="leaveType in leaveTypes" :key="leaveType.id" class="hover:bg-gray-100">
                    <td class="py-2 px-6 border-b">{{ leaveType.leave_name }}</td>
                    <td class="py-2 px-6 text-center border-b">{{ leaveType.requires_attachment ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-6 text-center border-b">{{ leaveType.auto_increase_entitlement ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-6 text-center border-b">{{ leaveType.increase_rate }} days/year</td>
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
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import axios from 'axios';

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  data() {
    return {
      leaveTypes: [
        { id: 1, leave_name: 'Sick Leave', requires_attachment: true, auto_increase_entitlement: true, increase_rate: 10},
        { id: 2, leave_name: 'AL', requires_attachment: true, auto_increase_entitlement: true, increase_rate: 10 } ,
      ] 
    };
  },
};
</script>