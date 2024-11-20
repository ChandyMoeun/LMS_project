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
            <div class="container">
              <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
                <router-link to="/Supervisor/Employee">
                  <svg class="w-6 h-6 mb-3 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                  </svg>
                </router-link>
                <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12">
                  <b>Member's Profile</b>
                </h1>
              </div>
              <div class="container mt-10 mx-auto p-6">
                <div v-if="member" class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
                  <div class="d-flex justify-content-center pt-5">
                    <img :src="  member.profile && member.profile ? `http://127.0.0.1:8000/images/${member.profile}` : '/images/default-profile.jpg' "
                      alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover" />
                  </div>
                  <div class="d-flex justify-around gap-4 p-6">
                    <!-- Left column -->
                    <div>
                      <p><strong>Staff ID: </strong>{{ member.staff_id }}</p>
                      <p><strong>Name: </strong>{{ member.full_name }}</p>
                      <p><strong>Gender: </strong>{{ member.gender }}</p>
                      <p><strong>Date of Birth: </strong>{{ member.dob }}</p>
                      <p><strong>Position: </strong>{{ member.position.name }}</p>
                      <p><strong>Department: </strong>{{ member.department.name }}</p>
                    </div>
                    <!-- Right column -->
                    <div>
                      <p><strong>Date Joined: </strong>{{ member.joined_date }}</p>
                      <p><strong>Confirm Date: </strong>{{ member.entitled_date }}</p>
                      <p><strong>Phone: </strong> 015637286</p>
                      <p><strong>Telegram Number: </strong> 015637286</p>
                      <p><strong>Email: </strong>{{ member.email }}</p>
                      <p><strong>Line Manager: </strong>{{ member.manager.full_name }}</p>
                    </div>
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
import { useAuthStore } from '@/stores/get-member'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  props: ['id'],
  setup(props) {
    const authStore = useAuthStore()
    // Find the member by ID from the store
    const member = authStore.member.find((m) => m.id === Number(props.id))
    return { member }
  }
}
</script>