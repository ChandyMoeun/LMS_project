<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="flex-1 overflow-x-hidden overflow-y-auto mt-10">
            <div style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray; ">
              <a href="/supervisor/settings">
                <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </a>
              <h1 class="font-bold text-gray-900 text-3xl mt-3 px-8 hover:text-yellow-400 w-3/12"><b>All Positions</b></h1>
            </div>
            <div class="w-4/6 mt-20">
              <input
                v-model="searchTerm"
                class="form-input px-2 w-2/6 h-9 ml-35 border-none rounded-md shadow-2xl shadow-blue-500/20"
                type="text"
                placeholder="Search department name..."
              />
            </div>
            <div class="flex justify-center">
              <div class="bg-white w-4/5 shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                  <thead>
                    <tr>
                      <th class="py-4 bg-gray-100 px-6 font-bold text-sm text-gray-700 border-b border-gray-200">Position Name</th>
                      <th class="py-4 bg-gray-100 px-6 font-bold text-sm text-gray-700 border-b border-gray-200">Department Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="hover:bg-gray-100">
                      <td class="py-4 px-6 border-b border-gray-200">Front End</td>
                      <td class="py-4 px-6 border-b border-gray-200">IT</td>
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
  import axios from 'axios';
  import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
    components: { SupervisorSidebar, WebHeaderMenu},
    data() {
      return {
        positions: [], // Array to hold positions data
        paginationData: {} // For handling pagination
      };
    },
    mounted() {
      this.getPositionList(); // Fetch positions when component is mounted
    },
    methods: {
      async getPositionList() {
        try {
          const response = await axios.get('http://localhost:8000/api/position/list');
          console.log(response)
        } catch (error) {
          console.error('Error fetching positions:');
        }
      }
    }
  };
  </script>
  
  
  <style scoped>
  .supervisor{
    display: flex;
    height: 100vh;
    align-items: start;
    width: 100%;
    background-color: #E5E7EB;
  }
  .sidebar{
    width: 17%;
    height: auto;
    background-color: #141c2e;
    color: white;
  }
  .container-page {
    width: 83%;
  }
  main{
    padding: 50px 50px 0px 50px;
    height: auto;
    width: 100%;
    background-color: #E5E7EB;
    margin-bottom: 50px;
  }
  
  </style>