<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="flex-1 overflow-x-hidden overflow-y-auto mt-10">
          <div style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray; " >
            <a href="/supervisor/settings">
              <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" /> 
              </svg>
            </a>
            <h1 class="font-bold text-gray-900 text-3xl mt-3 px-8 hover:text-yellow-400 w-3/12">
              <b>All Positions</b>
            </h1>
          </div>
          <div class="w-4/6 mt-20">
            <input v-model="searchTerm"
              class="form-input px-2 w-2/6 h-9 ml-35 border-none rounded-md shadow-2xl shadow-blue-500/20"
              type="text" placeholder="Search department name..." />
          </div>
          <div class="flex justify-center">
            <div class="bg-white w-4/5 shadow-md rounded my-6">
              <table class="text-left w-full border-collapse">
                <thead>
                  <tr>
                    <th class="py-4 bg-gray-100 px-6 font-bold text-sm text-gray-700 border-b border-gray-200"> Position Name </th>
                    <th class="py-4 bg-gray-100 px-6 font-bold text-sm text-gray-700 border-b border-gray-200"> Department Name </th>
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