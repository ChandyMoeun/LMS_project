<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main class="bg-gray-200">
          <div class="flex text-black my-5" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/employee/settings">
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
                <th class="bg-black text-white">Type</th>
                <th class="bg-black text-white text-center">Used</th>
                <th class="bg-black text-white text-center">Available</th>
                <th class="bg-black text-white text-center">Allowance</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(leave, index) in leaveBalances" :key="index">
                <td style="overflow-wrap: break-word; word-break: break-word">
                  <div
                    class="d-flex flex-row d-inline-block"
                    style="overflow-wrap: break-word; word-break: break-word">
                    <div>
                      <i
                        class="mr-2 fa fa-circle"
                        :style="{ color: leave.color }"
                        aria-hidden="true"
                      ></i>
                    </div>
                    <div>{{ leave.name }}</div>
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
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>
  <script>
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
export default {
  components: { EmployeeSidebar, EmployeeNavbar },
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
  
  <style scoped>
.employee {
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #e5e7eb;
}
.sidebar {
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main {
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #e5e7eb;
  margin-bottom: 50px;
}
</style>
  