<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-3 px-10">
            <div style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray; " >
              <a href="/supervisor/settings">
                <svg class="w-6 h-4 text-gray-800 dark:text-white mt-5 hover:text-gray-500"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" /> 
                </svg>
              </a>
              <h1 class="font-bold text-gray-900 text-3xl mt-2 px-8 hover:text-yellow-400 w-3/12">
                <b>All Positions</b>
              </h1>
            </div>
            <div class="flex justify-center mt-10">
              <div class="bg-white w-4/5 shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                  <thead>
                    <tr class="bg-black">
                      <th class="py-4 px-6 font-bold text-sm text-white border-b border-gray-200"> Position Name </th>
                      <th class="py-4 px-6 font-bold text-sm text-white border-b border-gray-200"> Department Name </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="position in positionStore.positions" :key="position.id" class="hover:bg-white text-xs">
                      <td class="py-4 px-6 border-b border-gray-200">{{ position.position }}</td>
                      <td class="py-4 px-6 border-b border-gray-200">{{ position.department }}</td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-right p-4 py-10">
                  <pagination :data="paginationData" @pagination-change-page="getPositions" />
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
import { usePositionStore } from '@/stores/all-positions'
import { onMounted } from 'vue'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  setup() {
    const positionStore = usePositionStore()
    // Fetch data on component mount
    onMounted(() => {
      positionStore.fetchPositions() // Fetch positions
      console.log(positionStore.fetchPositions())
    })
    return {
      positionStore // Access positions from store
    }
  }
}
</script>