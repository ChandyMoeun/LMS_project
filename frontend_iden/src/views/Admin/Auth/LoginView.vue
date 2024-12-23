<template>
  <div class="flex justify-center">
    <el-card class="w-5/6 mt-20">
      <div class="flex">
        <!-- Left section with image -->
        <div class="flex flex-col justify-center" style="width: 50%;">
          <img src="../../../assets/image/login.png" alt="Login Illustration" class="object-cover">
          <p class="flex mb-5 justify-center text-sm" style="color: #B7B7B7;">Sign in here to join iDEN leave management system.</p>
        </div>

        <!-- Right section with form -->
        <div class="flex flex-col w-3/6 px-5">
          <h4 class="font-bold text-4xl w-2/6 hover:text-yellow-300 mt-5 mb-3 text-center">SIGN IN</h4>
          <el-form @submit.native.prevent="onSubmit">
            <!-- Email field -->
            <el-form-item :error="emailError" :class="{ 'is-error': emailError }">
              <el-input 
                placeholder="Email Address" 
                v-model="email" 
                size="large" 
                :class="{ 'is-invalid': emailError }" 
              />
            </el-form-item>

            <!-- Password field -->
            <el-form-item :error="passwordError" class="mt-8" :class="{ 'is-error': passwordError }">
              <el-input 
                placeholder="Password" 
                v-model="password" 
                size="large" 
                type="password" 
                :class="{ 'is-invalid': passwordError }" 
              />
            </el-form-item>

            <!-- Forgot password -->
            <div class="flex justify-end items-center mb-4 mr-7">
              <a href="#" class="text-blue-500 text-sm">Forgot password?</a>
            </div>

            <!-- Submit button -->
            <el-button 
              size="large" 
              class="mt-3 w-1/6" 
              :disabled="isSubmitting" 
              type="primary" 
              native-type="submit">
              Submit
            </el-button>
          </el-form>
        </div>
      </div>
    </el-card>
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

// Validation schema
const formSchema = yup.object({
  email: yup
    .string()
    .required('Email is required')
    .email('Invalid email address'),
  password: yup
    .string()
    .required('Password is required')
    .min(8, 'Password must be at least 8 characters long'),
})

// Form setup
const { handleSubmit, isSubmitting, setFieldError } = useForm({
  initialValues: {
    email: '',
    password: '',
  },
  validationSchema: formSchema,
})

// Submit handler
const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/')
  } catch (error) {
    if (error.response && error.response.status === 401) {
      // Set error message for incorrect password
      setFieldError('password', 'Your input wrong password')
    } else {
      console.warn('Error during login:', error)
    }
  }
})

// Field setup
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
</script>

<style scoped>
.is-error .el-input {
  border-color: #ff4d4f;
}
.is-invalid {
  border-color: #ff4d4f;
}
</style>
