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
          <a href="/Supervisor/Settings">
            <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
          </a>
          <h1 class="font-bold text-gray-900 text-3xl mt-3 px-8 hover:text-yellow-400 w-1/12"><b>Position</b></h1>
        </div>
        <div class="container mx-auto px-6 py-2 mt-3">
          <div class="text-right mr-8 mt-16">
            <a href="/Supervisor/Settings/Positions/Create" class="bg-black text-white font-bold px-2 py-2 rounded focus:outline-none no-underline shadow hover:bg-yellow-400 transition-colors"> New Position </a>
          </div>
  
          <div class="bg-white shadow-md rounded my-6">
            <table class="text-left w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 bg-gray-100 px-6 font-bold text-sm text-gray-700 border-b border-gray-200">Position Name</th>
                  <th class="py-4 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200">Department Name</th>
                  <th class="py-4 text-center px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-right w-2/12">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr class="hover:bg-gray-100">
                  <td class="py-4 px-6 border-b border-gray-200">Front End</td>
                  <td class="py-4 px-6 border-b border-gray-200">IT</td>
                  <td class="py-4 px-6 border-b border-gray-200 text-right">
                    <a href="/Supervisor/Settings/Positions/Update" class="font-bold no-underline py-1 px-3 mr-3 border-none rounded text-xs bg-gray-900 hover:bg-yellow-400 text-white">Edit</a>
                    <button @click="deletePosition(position.id)" class="font-bold py-1 px-3 border-none rounded text-xs bg-red-500 hover:bg-red-400 text-white">Delete</button>
                  </td>
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
  import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
    components: { SupervisorSidebar, WebHeaderMenu },
    data() {
      return {
        positions: [], // Array to hold positions data
        paginationData: {} // For handling pagination
      };
    },
    mounted() {
      this.getPositions(); // Fetch positions when component is mounted
    },
    methods: {
      getPositions(page = 1) {
        // Fetch positions from API
        axios.get(`/api/positions?page=${page}`)
          .then(response => {
            this.positions = response.data.data;
            this.paginationData = response.data.meta;
          })
          .catch(error => {
            console.error("Error fetching positions", error);
          });
      },
      createNewPosition() {
        // this.$router.push({ path: '/Supervisor/Settings/Positions/Create' });

      },
      methods: {
    goToUpdatePage() {
      // This will navigate to the desired route
      this.$router.push('/Supervisor/Settings/Positions/Update');
    }
      },
     
      deletePosition(id) {
          // Handle deletion logic
          alert(`Position with ID ${id} deleted`);
          // Further logic to delete the position from data
          this.department.positions = this.department.positions.filter(position => position.id !== id);
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