<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky flex-1 overflow-x-hidden overflow-y-auto mt-10 p-5">
            <div class="container mx-auto px-6 py-2 ">
          <div class="mb-5" style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
            <a href="/Supervisor/Settings/Departments">
              <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
              </svg>
            </a>
            <h1 v-if="canAccess('Department access')" class="font-bold text-3xl mt-2 hover:text-yellow-400 w-5/12 px-8"><b>Department: {{ department.name }}</b></h1>
          </div>
          <div class="flex items-center justify-between mt-20 px-9">
            <div class="relative mx-4 lg:mx-0">
              <a class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                  <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </a>
              <input v-model="search" class="form-input w-32 h-9 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="Search department name...">
            </div>
            <div class="text-right">
              <a href="/Supervisor/Settings/Positions/Create" class="bg-gray-900 no-underline text-white font-bold px-2 py-2 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">New Position</a>
            </div>
          </div>
  
          <div class="d-flex justify-center bg-white shadow-md rounded my-6">
            <table class="text-left w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200">Position Name</th>
                  <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-right w-2/12">Actions</th>
                </tr>
              </thead>
              <tbody v-if="canAccess('Department access')">
                <tr v-for="position in filteredPositions" :key="position.id" class="hover:bg-gray-100">
                  <td class="py-4 px-6 border-b border-gray-200">
                    <p>{{ position.name }}</p>
                  </td>
                  <td class="py-4 px-6 border-b border-gray-200 text-right">
                    <a href="/Supervisor/Settings/Positions/Update" class="text-white no-underline font-bold py-1 mr-2 px-3 rounded text-xs bg-black hover:bg-yellow-400">Edit</a>
                    <a href="#" @click.prevent="deletePosition(position.id)" class="text-white no-underline font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400">Delete</a>
                  </td>
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
  export default {
    components: { SupervisorSidebar, WebHeaderMenu },
    data() {
      return {
        search: '',
        department: {
          name: 'Engineering',
          positions: [
            { id: 1, name: 'Manager' },
            { id: 2, name: 'Developer' }
          ]
        }
      };
    },
    computed: {
      filteredPositions() {
        return this.department.positions.filter(position => 
          position.name.toLowerCase().includes(this.search.toLowerCase())
        );
      }
    },
    methods: {
      canAccess(permission) {
        // Logic to check permission, for example using Vuex store or directly
        // assuming user has all permissions for demo purposes
        return true;
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
  