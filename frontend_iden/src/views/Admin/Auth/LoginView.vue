<template>
  <div class="d-flex justify-center mt-40">
    <main class="d-flex w-5/6 px-10 flex bg-white rounded-lg shadow-lg overflow-hidden bg-gray-#F9F9F9">
      <!-- Left section with image -->
      <div class=" flex d-flex flex-col justify-center" style="width: 50%; ">
        <img src="../../../assets/image/login.png" alt="Login Illustration" class="object-cover">
        <p class=" flex mb-5 justify-center text-sm" style="color: #B7B7B7;">Sign in here to join iDEN leave management system.</p>
      </div>
      <!-- Right section with form -->
      <div class="w-1/2 p-3 flex flex-col justify-center">
        <h1 class="font-bold text-4xl mr-5 mb-6 text-center"><B>SIGN IN</B></h1>
        <form>
          <div class="mb-4 mr-3">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your email" required autofocus>
          </div>
          <div class="mb-4 mr-3">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your password" required autocomplete="current-password">
          </div>
          <div class="flex justify-end items-center mb-4 mr-7">
            <a href="#" class="text-blue-500 text-sm">Forgot password?</a>
          </div>
          <button type="submit" class="bg-blue-500 text-white border-none font-bold py-2 px-3 mb-5 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px">Sign in</button>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'

const router = useRouter()
const store = useAuthStore()

const formSchema = yup.object({
  password: yup.string().required().label('Password'),
  email: yup.string().required().email().label('Email address')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    password: '',
    email: ''
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    localStorage.setItem('access_token', data.access_token)
    console.log(store);
    router.push('/')
  } catch (error) {
    console.warn('Error')
  }
})

const { value: password, errorMessage: nameError } = useField('password')
const { value: email, errorMessage: emailError } = useField('email')
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>