<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray-200 sticky flex-1 overflow-x-hidden overflow-y-auto mt-10 p-5">
            <div class="container mx-auto px-6 py-2 ">
          <div class="mb-5" style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
            <a href="/supervisor/settings/departments">
              <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
              </svg>
            </a>
            <h1 v-if="canAccess('Department access')" class="font-bold text-3xl mt-2 hover:text-yellow-400 w-4/12 px-8"><b>Department: {{ department.name }}</b></h1>
          </div>
          <div class="w-4/6 mt-20">
            <input
              v-model="searchTerm"
              class="form-input px-2 w-3/6 h-9 ml-30 border-none rounded-md shadow-2xl shadow-blue-500/20"
              type="text"
              placeholder="Search department name..."
            />
          </div>
  
          <div class="flex justify-center">
            <div class="w-5/6 bg-white shadow-md rounded my-6">
              <table class="w-full border-collapse">
                <thead>
                  <tr>
                    <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-center">Position Name</th>
                    <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-center w-2/12">Total</th>
                  </tr>
                </thead>
                <tbody v-if="canAccess('Department access')">
                  <tr v-for="position in filteredPositions" :key="position.id" class="hover:bg-gray-100">
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      <p>{{ position.name }}</p>
                    </td>
                    <td class="py-4 w-3/6 px-6 border-b border-gray-200 text-center ">
                      <span class="text-gray-500 no-underline font-bold py-1 mr-2 px-3 rounded text-xs">sum total Employee work on that position </span>
                    </td>
                  </tr>
                </tbody>
              </table>
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
  