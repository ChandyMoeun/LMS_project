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
              <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/employee/myleave/historyleave">
                  <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                  </svg>
                </router-link>
                <h1 class="font-bold mr-20 text-3xl px-8 w-4/12 mt-3 hover:text-yellow-400">
                  <b>My Leave History</b>
                </h1>
              </div>
            <!-- Leave Request Details -->

            <div
              v-if="request"
              class="max-w-4xl mx-auto mt-20 p-5 bg-gray-100 rounded-lg shadow-md"
            >
              <!-- Left Column: Request Details -->
              <div class="grid grid-cols-2 gap-8">
                <div>
                  <div class="mb-4">
                    <span class="font-semibold">Date:</span>
                    <p class="mt-1">📅 {{ request.from_date }} | {{ request.to_date }}</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested at:</span>
                    <p class="mt-1">📅 {{ request.created_at }}</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Part of day:</span>
                    <p class="mt-1">
                      <span v-if="request.start_time && request.end_time"
                        >time: {{ request.start_time }} | {{ request.end_time }}</span
                      >
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
                      />
                      {{ request.employee_name }}
                    </p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Reason:</span>
                    <textarea
                      :value="request.reason"
                      disabled
                      class="w-full p-2 mt-1 border rounded-md bg-gray-50"
                    >
                    </textarea>
                  </div>
                </div>
                <!-- Right Column: Approval Details -->
                <div>
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
                      <span v-if="request.status === 'approved'">{{ request.approved_by }}</span>
                      <span v-else>{{ request.rejected_by }}</span>
                    </p>
                  </div>
                  <div class="mb-4">
                    <span class="font-semibold">Comment:</span>
                    <textarea disabled class="w-full p-2 mt-1 border rounded-md bg-gray-50">
Okay.</textarea
                    >
                  </div>
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
import { ref, computed, onMounted } from 'vue'
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'
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

// If additional data or logic is needed, you can use `ref`, `reactive`, or other Vue Composition API features.
</script>
    
      
  

    
