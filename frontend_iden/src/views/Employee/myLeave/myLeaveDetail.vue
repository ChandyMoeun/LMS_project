<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main class="bg-gray sticky top-0">
          <div class="mt-10 pb-20">
            <div
              class="flex text-black"
              style="display: flex; flex-direction: column; border-bottom: solid 1px gray"
            >
              <router-link to="/employee/myleave">
                <svg
                  class="w-6 h-6 text-gray-800 hover:text-gray-500"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 5H1m0 0 4 4M1 5l4-4"
                  />
                </svg>
              </router-link>
              <h1 class="font-bold mr-20 text-3xl px-8 w-4/12 mt-3 hover:text-yellow-400">
                <b>My Leave Detail</b>
              </h1>
            </div>
            <div class="printpage d-flex justify-end mr-8 gap-3 mt-16">
              <button
                @click="Export"
                class="border-none bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500"
              >
                Export
              </button>
              <button
                @click="printSection"
                class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500"
              >
                Print
              </button>
            </div>
            <!-- Left Column: Request Details -->
            <div
              id="detailleave"
              class="grid grid-cols-2 gap-8 mt-3 p-5 bg-gray-100 rounded-lg shadow-md"
            >
              <div v-if="request">
                <div class="mb-4">
                  <span class="font-semibold">Date:</span>
                  <p class="mt-1">
                    📅 {{ request.from_date}} | {{ request.to_date }}
                  </p>
                </div>

                <div class="mb-4">
                  <span class="font-semibold">Requested at:</span>
                  <p class="mt-1">📅 {{ request.created_at }}</p>
                </div>

                <div class="mb-4">
                  <span class="font-semibold">Part of day:</span>
                  <p class="mt-1">
                    <span v-if="request.start_time && request.end_time">time: {{ request.start_time }} | {{ request.end_time }}</span>
                    <span v-else>{{ request.half_day_type }}</span>
                  </p>
                </div>

                <div class="mb-4">
                  <span class="font-semibold">Requested by:</span>
                  <p class="mt-1 flex items-center">
                    <img
                      class="h-6 w-6 rounded-full mr-2"
                      :src="
                          request.profile && request.profile
                            ? `http://127.0.0.1:8000/images/${request.profile}`
                            : '/images/default-profile.jpg'
                        "
                    />{{ request.employee_name }}
                  </p>
                </div>
                <div class="mb-4">
                  <span class="font-semibold">Reason:</span>
                  <p disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">
                    {{ request.reason }}
                  </p>
                </div>
              </div>
              <!-- Right Column: Approval Details -->
              <div v-if="request">
                <div class="mb-4">
                  <span class="font-semibold">Type of leave:</span>
                  <p class="mt-1">{{ request.leave_type }}</p>
                </div>
                <div class="mb-4">
                  <span class="font-semibold">Status:</span>
                  <p class="mt-1">{{ request.status }}</p>
                </div>
                <div class="mb-4">
                  <span class="font-semibold">Approved at:</span>
                  <p class="mt-1">📅 {{ request.updated_at }}</p>
                </div>
                <div class="mb-4">
                  <span class="font-semibold">Approval by:</span>
                  <p class="mt-1 flex items-center">
                    <img
                      class="h-6 w-6 rounded-full mr-2"
                      src="https://via.placeholder.com/40"
                      alt="Profile"
                    />
                    <span v-if="request.status==='approved'">{{ request.approved_by }}</span>
                    <span v-else>{{ request.rejected_by }}</span>
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
  
<script setup>
import { ref, onMounted } from 'vue'
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
import html2pdf from 'html2pdf.js'

// Define props
const props = defineProps({
  id: {
    type: [String, Number],
    required: true
  }
})

// Reactive variable for the request
const request = ref(null)

// Access the store
const authStore = useLeaveRequestStore()

onMounted(async () => {
  await authStore.fetchTeamLeaveRequests()

  // Find the request by ID
  request.value = authStore.leaveRequests.find((m) => m.id === Number(props.id))

  // Log request and found ID
  console.log('Request Data:', request.value)
  console.log('Request ID:', props.id)
})

// Method to handle printing
const printSection = () => {
  const printContents = document.getElementById('detailleave').innerHTML
  const originalContents = document.body.innerHTML
  document.body.innerHTML = printContents
  window.print()
  document.body.innerHTML = originalContents
  window.location.reload() // Reload to reset original contents
}

// Method to handle PDF export
const Export = () => {
  const element = document.getElementById('detailleave')
  const options = {
    margin: 1,
    filename: 'Leave_Detail.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
  }
  html2pdf().set(options).from(element).save()
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
