<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0">
          <div class="container pb-20">
                <!-- Header -->
            <div class="mt-5 text-black" style="border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl px-8 mb-3 hover:text-yellow-400 w-4/12">Employee Dashboard</h1>
            </div>
            <!----------- alert code -------------------->
            <div class="button" style="margin: 50px">
              <!-- Toast Alert Box -->
              <div class="button" style="margin: 50px">
                <div v-show="isToastVisible"
                  class="toast-box"
                  style=" position: absolute; top: 5%; right: 2%; display: flex; align-items: flex-end; flex-direction: column; overflow: hidden; padding: 2px; width: 23%;">
                  <div
                    role="alert"
                    class="mb-4 relative flex w-full p-3 pr-5 text-sm text-white bg-black rounded-md items-center">
                    {{ alertMessage }}
                  </div>
                </div>
              </div>
            </div>
            <!----------- //end alert code //--------------------> 

            <!--............................// Chart js // total employee leave balance chart ..............................  -->
            <div class="chartjs mb-10 px-8 py-10">
              <!-- Chart Container -->
              <h1 class="text-4xl text-black p-10 text-center">Employee Dashboard</h1>  
              <div class="chart-container flex justify-center mb-10 rounded-2xl py3 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <canvas id="myLeaveBalance" style="width:100%; max-width:800px; height:100vh; max-height:70vh;"></canvas>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script setup lang="ts">
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'

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
</script>


<style scoped>
.supervisor {
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