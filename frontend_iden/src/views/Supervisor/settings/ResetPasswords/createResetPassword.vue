<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky mt-5">
            <div style="display: flex; color: black; flex-direction: column; border-bottom: solid 1px gray">
                <router-link to="/Supervisor/Settings/ResetPassword">
                <svg class="w-6 h-4 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                </router-link>
                <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-4/12"><b>Reset Password for {{ employee.full_name }}</b></h1>
            </div>
    
            <!-- Display success message -->
            <div v-if="successMessage" id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ successMessage }}
            </div>
        
            <!-- Display validation errors -->
            <div v-if="errorMessages.length" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                <li v-for="error in errorMessages" :key="error">{{ error }}</li>
                </ul>
            </div>
        
            <!-- Reset password form -->
            <form @submit.prevent="submitForm" class="bg-white mt-20 p-5 shadow-md rounded-lg overflow-hidden">
                <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">New Password</label>
                <input
                    type="password"
                    v-model="form.password"
                    id="password"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                />
                <span v-if="form.password.length < 8" class="text-red-500 text-sm">Password must be at least 8 characters long.</span>
                </div>
        
                <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-bold mb-2">Confirm Password</label>
                <input
                    type="password"
                    v-model="form.password_confirmation"
                    id="password_confirmation"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                />
                <span v-if="form.password !== form.password_confirmation" class="text-red-500 text-sm">Password confirmation does not match.</span>
                </div>
        
                <div class="flex justify-center">
                <button type="submit" class="bg-yellow-500 border-none hover:bg-black text-white font-bold py-2 px-3 rounded">
                    Reset Now
                </button>
                </div>
            </form>
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>
  
  <script>
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  setup() {
    const route = useRoute()
    const router = useRouter()
    const employee = ref({})
    const form = ref({
      password: '',
      password_confirmation: ''
    })
    const successMessage = ref('')
    const errorMessages = ref([])

    const fetchEmployee = async () => {
      try {
        const response = await axios.get(`/api/employee/${route.params.id}`) // Replace with actual API
        employee.value = response.data
      } catch (error) {
        console.error('Error fetching employee data:', error)
      }
    }

    const submitForm = async () => {
      try {
        const response = await axios.post(
          `/api/employee/${employee.value.id}/reset-password`,
          form.value
        ) // Replace with actual API
        successMessage.value = 'Password has been reset successfully!'
        form.value.password = ''
        form.value.password_confirmation = ''
        setTimeout(() => {
          successMessage.value = ''
          router.push({ name: 'resetPasswordIndex' })
        }, 4000) // Hide message after 4 seconds
      } catch (error) {
        errorMessages.value = error.response.data.errors
      }
    }

    onMounted(fetchEmployee)

    return {
      employee,
      form,
      successMessage,
      errorMessages,
      submitForm
    }
  }
}
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
  