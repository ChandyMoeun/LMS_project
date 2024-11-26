<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main class="bg-gray sticky top-0">
          <div class="container pb-30">
                <!-- Header -->
            <div class="mt-5 text-black" style="border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-400 w-4/12">Employee Dashboard</h1>
            </div>
            <!----------- alert code -------------------->
                        <!----------- alert code -------------------->
                        <div v-show="isToastVisible" class="toast-box"
                  style=" position: absolute; top: 7%; right: 2%; display: flex; align-items: flex-end; flex-direction: column; overflow: hidden; padding: 2px; width: 23%;">
                  <div role="alert" class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                    {{ alertMessage }}
                  </div>
                </div>
            <!----------- //end alert code //--------------------> 

            <!--............................// Chart js // total employee leave balance chart ..............................  -->
             <!-- Chart Container -->
              <h1 class="text-4xl text-black p-10 text-center">My Leave Balance</h1>  
              <div class="chart-container flex justify-center mb-10 rounded-2xl bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="myLeaveBalance" style="width:100%; max-width:800px; height:100vh; max-height:70vh;"></canvas>
              </div>
            <!--............................list of my requesting leaves ..............................  -->
            <div class="px-8 overflow-x-auto">
              <h1 class="text-4xl p-10 text-black text-center">My Requesting Leaves</h1>
              <table class="min-w-full bg-gray-100 border border-gray-100">
                <thead>
                  <tr class="bg-black text-white text-xs">
                    <th class="py-2 px-2 text-center border-b">ID</th>
                    <th class="py-2 px-2 text-center border-b">Profile</th>
                    <th class="py-2 px-2 text-center border-b">Name</th>
                    <th class="py-2 px-2 text-center border-b">Type</th>
                    <th class="py-2 px-2 text-center border-b">Position</th>
                    <th class="py-2 px-2 text-center border-b">From | To</th>
                    <th class="py-2 px-2 text-center border-b">Approver</th>
                    <th class="py-2 px-2 text-center border-b">Sub-approver</th>
                    <th class="py-2 px-2 text-center border-b">Status</th>
                    <th class="py-2 px-2 text-center border-b">Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hover:bg-white text-xs" v-for="(request, index) in leaveRequests" :key="index">
                    <td class="py-2 px-2 text-center border-b">{{ request.id }}</td>
                    <td class="flex py-2 px-2 justify-center border-b">
                      <img src="../../assets/image/profile-avatar.jpg" alt="Profile Image" class="w-12 h-12 rounded-full object-cover" />
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ request.name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.position }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.date }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.approver }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ request.subApprover }}</td>
                    
                    <!-- Dropdown status update -->
                    <td class="py-2 px-2 text-center border-b">
                      
                      <div>
                        <span :class="statusClass(request.status)">{{ request.status }}</span>
                      </div>
                    </td>
                    
                    <td class="py-2 px-2 text-center border-b text-xs">
                      <a href="/employee/myleave/view/detail" class="text-blue-500 no-underline hover:text-blue-400">More</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script setup lang="ts">
import EmployeeLayout from '@/Components/Layouts/EmployeeLayout.vue';
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'

import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'

// Function to create Employee Chart
const employeeLeaveBalance = () => {
  var xValues = ["AL", "Special", "ML", "Sick Leave", "UPL"];
  var yValues = [18, 7, 7, 30, 30];
  var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145"
  ];

  new Chart("myLeaveBalance", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: "My Leave Balance Chart"
        }
      }
    }
  });
}

// Mount the charts once the component is mounted
onMounted(() => {
  employeeLeaveBalance()
})

// Reactive state for toast visibility and message
const isToastVisible = ref(false)
const alertMessage = ref('Welcome To Dashboard! How are you?')

// Function to show the alert
const showToast = () => {
  isToastVisible.value = true
  setTimeout(() => {
    isToastVisible.value = false
  }, 4000) // Hide after 4 seconds
}

// Automatically show the alert on component mount
onMounted(() => {
  showToast()
})

// Sample data for leave requests
const leaveRequests = ref([
  { id: 1, name: 'John Doe', type: 'Sick Leave', position: 'Developer', date: '12.02.2024 | 12.03.2024', approver: 'Approver1', subApprover: 'Sub1', status: 'Pending' },
  { id: 2, name: 'Jane Doe', type: 'Annual Leave', position: 'Designer', date: '01.01.2024 | 01.02.2024', approver: 'Approver2', subApprover: 'Sub2', status: 'Approved' }
]);

const dropdownVisible = ref(null);

// Method to toggle the visibility of the dropdown
const toggleDropdown = (index) => {
  dropdownVisible.value = dropdownVisible.value === index ? null : index;
};

// Method to handle status update
const updateStatus = (index) => {
  const updatedStatus = leaveRequests.value[index].status;
  // Do something with the updated status, like sending it to a server or storing it
  console.log(`Leave request ${leaveRequests.value[index].id} updated to: ${updatedStatus}`);
};

// Method to dynamically assign classes based on status
const statusClass = (status) => {
  switch (status) {
    case 'Pending':
      return 'bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    case 'Approved':
      return 'bg-green-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    case 'Rejected':
      return 'bg-red-400 text-white px-2 py-1 rounded-full text-xs font-semibold';
    default:
      return '';
  }
};
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