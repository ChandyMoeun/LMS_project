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
            <div class="mb-5" style=" display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray;">
              <a href="/supervisor/settings/departments">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </a>
              <!-- display name department -->
              <h1 class="font-bold text-3xl mt-2 hover:text-yellow-400 w-4/12 px-8">
                <b v-if="department">Department: {{ department.name }}</b>
              </h1>
            </div>
            <div class="w-4/6 mt-20">
              <input v-model="searchTerm" class="form-input px-2 w-3/6 h-9 ml-30 border-none rounded-md shadow-2xl shadow-blue-500/20" type="text" placeholder="Search department name..." />
            </div>

            <div class="flex justify-center">
              <div class="w-5/6 bg-white shadow-md rounded my-6">
                <table class="w-full border-collapse">
                  <thead>
                    <tr>
                      <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-center"> Position Name </th>
                      <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-center w-2/12"> Total </th>
                    </tr>
                  </thead>
                  <tbody v-if="department">
                    <!-- loop through positions and display them -->
                    <tr v-for="position in department.positions" :key="position.id" class="hover:bg-gray-100" >
                      <td class="py-4 px-6 border-b text-center border-gray-200">
                        <p>{{ position.name }}</p>
                      </td>
                      <!-- count employees in position -->
                      <td class="py-4 w-3/6 px-6 border-b border-gray-200 text-center">
                        <span
                          class="text-gray-500 no-underline font-bold py-1 mr-2 px-3 rounded text-xs"
                          >{{ position.employees_count }}
                        </span>
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
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { useDepartmentStore } from '@/stores/department'
import { onMounted, ref } from 'vue'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  props: ['departmentId'],
  setup(props) {
    const departmentStore = useDepartmentStore()
    const department = ref(null)
    // ====>Fetch department data when the component is mounted<====
    onMounted(async () => {
      await departmentStore.fetchDepartmentId(props.departmentId)
      department.value = departmentStore.departments[0] 
    })
    return {
      department
    }
  }
}
</script>