<template>
  <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-10 pb-20 px-10">
            <div class="flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/supervisor/takeleave">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold mr-20 text-3xl px-8 w-4/12 mt-3 hover:text-yellow-400">
                <b v-if="request">{{ request.employee_name }} Leave Detail</b>
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
                    <p class="mt-1">📅 {{ request.from_date }} | Full Day</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Requested at:</span>
                    <p class="mt-1">📅 {{ request.created_at }} &#128336;</p>
                  </div>

                  <div class="mb-4">
                    <!-- Check if start_time and end_time are present -->
                    <p v-if="request.start_time && request.end_time" class="mt-1">
                      <span class="font-semibold">Part of Day:</span> <br />
                      By time: {{ request.start_time }} | {{ request.end_time }} &#128336;
                    </p>

                    <!-- If no start_time and end_time, display half_day_type -->
                    <p v-else class="mt-1">
                      <span class="font-semibold">Part of Day: <br /></span>
                      {{ request.half_day_type }}
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
                    <textarea
                      :value="request.reason"
                      disabled
                      class="w-full p-2 mt-1 border rounded-md bg-gray-50"
                    ></textarea>
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
                    <p v-if="request.status === 'approved'" class="mt-1">
                      📅 {{ request.updated_at }} &#128336;
                    </p>
                    <p v-else class="mt-1 text-gray-500">Not yet approved</p>
                  </div>

                  <div class="mb-4">
                    <span class="font-semibold">Approval by:</span>
                    <p class="mt-1 flex items-center">
                      <img
                        class="h-6 w-6 rounded-full mr-2"
                        src="https://via.placeholder.com/40"
                        alt="Profile"
                      />{{ request.approved_by }}
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
  </SupervisorLayout>
</template>
  
  <script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import { useLeaveRequestStore } from '@/stores/request-leave'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  props: ['id'],
  data() {
    return {
      request: null
    }
  },
  async mounted() {
    const authStore = useLeaveRequestStore()
    await authStore.fetchTeamLeaveRequests() 

    // ===>Find the request by ID after fetching<===
    this.request = authStore.leaveRequests.find((m) => m.id === Number(this.id))

    // ===>If request is not found, handle the case (optional)<=====
    if (!this.request) {
      console.error('Leave request not found!')
    }
  },
  methods: {
    formattedDate(dateString) {
      return new Date(dateString).toLocaleDateString() 
    }
  }
}
</script>