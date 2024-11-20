<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-10 pb-20 px-10">
            <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/employee/myleave">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold mr-20 text-3xl px-8 w-4/12 mt-3 hover:text-yellow-400">
                <b>My Leave Detail</b>
              </h1>
            </div>
            <div class="printpage d-flex justify-end mr-8 gap-3 mt-16">
              <button @click="Export" class="border-none bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500">Export</button>
              <button @click="printSection" class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500">Print</button>
            </div>
              <!-- Left Column: Request Details -->
              <div id="detailleave" class="grid grid-cols-2 gap-8 mt-3 p-5 bg-gray-100 rounded-lg shadow-md">
                <div>
                  <div class="mb-4">
                    <span class="font-semibold">Date:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | Full Day</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested at:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | 10:23 AM</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Part of day:</span>
                    <p class="mt-1">Full Day</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested by:</span>
                    <p class="mt-1 flex items-center"> <img class="h-6 w-6 rounded-full mr-2" src="https://via.placeholder.com/40" alt="Profile" />Kris Wang</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Reason:</span>
                    <p disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">Dear Mr.Cat, I would like to ask for permission to take leave one day. Because I'm feeling sick.</p>
                  </div>
                </div>
                <!-- Right Column: Approval Details -->
                <div>
                  <div class="mb-4">
                    <span class="font-semibold">Type of leave:</span>
                    <p class="mt-1">Sick leave</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Status:</span>
                    <p class="mt-1">Approved</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Approved at:</span>
                    <p class="mt-1">📅 Thu 13 Aug 2024 | 10:30 AM</p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Approval by:</span>
                    <p class="mt-1 flex items-center">
                      <img class="h-6 w-6 rounded-full mr-2" src="https://via.placeholder.com/40" alt="Profile"/>Cat
                    </p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Comment:</span>
                    <p disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">Okay.</p>
                  </div>
                </div>
              </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>
  
  <script>
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import html2pdf from 'html2pdf.js'

export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      // Data can be added if needed for dynamic rendering
    }
  },
  methods: {
    printSection() {
      const printContents = document.getElementById("detailleave").innerHTML;
      const originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      window.location.reload(); // Reload to reset original contents
    },
    Export() {
      const element = document.getElementById("detailleave");
      const options = {
        margin: 1,
        filename: 'Leave_Detail.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
      html2pdf().set(options).from(element).save();
    }
  }
}
</script>
  
<style scoped>
@media print {
  /* Hide everything but the print section */
  body * {
    visibility: hidden;
  }
  #detailleave,
  #detailleave * {
    visibility: visible;
  }
  #detailleave {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
  }
}
</style>