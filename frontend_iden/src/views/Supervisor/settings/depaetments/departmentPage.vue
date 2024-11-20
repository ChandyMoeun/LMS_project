<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="flex-1 overflow-x-hidden overflow-y-auto mt-5 p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="px-10">
            <!-- Header Section -->
            <div style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray; " >
              <router-link to="/supervisor/settings">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl mt-2 px-8 hover:text-yellow-400 w-1/6">Departments</h1>
            </div>
            <!-- Search and Create Button Section -->
            <div class="relative w-3/6 mt-20 mx-4 lg:mx-0">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                  <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ></path>
                </svg>
              </div>
              <input v-model="searchTerm" class="form-input h-9 w-4/6 rounded-md pl-10 focus:border-indigo-600" type="text" placeholder="Search department name..." />
            </div>

            <!-- Departments Table -->
            <div class="bg-white shadow-md rounded my-6">
              <table class="text-left w-full border-collapse">
                <thead class="bg-black">
                  <tr>
                    <th class="py-4 px-6 w-3/12 font-bold text-sm text-white border-b border-gray-200" > Department Name </th>
                    <th class="py-4 px-6 w-5/12 font-bold text-sm text-white text-center border-b border-gray-200" > Supervisor Name </th>
                    <th class="py-4 px-6 w-3/12 font-bold text-sm text-white text-center border-b border-gray-200" > Actions </th>
                  </tr>
                </thead>
                <tbody v-if="Departments">
                  <tr v-for="department in filteredDepartments" :key="department.id" class="hover:bg-gray-100">
                    <td class="py-4 px-4 border-b border-gray-200">{{ department.name }}</td>
                    <td class="py-4 text-center px-4 border-b border-gray-200">
                      {{ department.manager_name || 'No manager assigned' }}
                    </td>
                    <td class="flex py-4 px-2 justify-center gap-2 border-b border-gray-200">
                      <router-link :to="`/Supervisor/Settings/Departments/View/${department.id}`"
                        class="text-white font-bold py-1 px-3 rounded text-xs no-underline bg-blue-500 hover:bg-blue-400">View</router-link>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                      <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-600">No department found.</td>
                      </tr>
                    </tbody>
              </table>

              <!-- Pagination -->
              <div class="text-right p-4 py-10">
                <pagination-component :total-pages="totalPages" :current-page="currentPage" @page-changed="loadDepartments" />
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
import { useDepartmentStore } from '@/stores/department'
import { onMounted, computed, ref } from 'vue'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  setup() {
    const departmentStore = useDepartmentStore()
    const searchTerm = ref('')
    const currentPage = ref(1)
    const totalPages = ref(3)

    // Fetch data on component mount
    onMounted(() => {
      departmentStore.fetchDepartments()
    })

    // Computed property for filtered departments
    const filteredDepartments = computed(() => {
      return departmentStore.departments.filter((department) =>
        department.name.toLowerCase().includes(searchTerm.value.toLowerCase())
      )
    })

    // Method to handle pagination (if needed)
    const loadDepartments = (page) => {
      currentPage.value = page
      departmentStore.fetchDepartments(page)
    }

    return {
      searchTerm,
      filteredDepartments,
      currentPage,
      totalPages,
      loadDepartments,
    }
  }
}
</script>