<template>
  <div class="flex justify-center">
    <el-card class="w-5/6 mt-20">
      <div class="flex">
        <!-- Left section with image -->
        <div class=" flex flex-col justify-center" style="width: 50%; ">
          <img src="../../../assets/image/login.png" alt="Login Illustration" class="object-cover">
          <p class=" flex mb-5 justify-center text-sm" style="color: #B7B7B7;">Sign in here to join iDEN leave management system.</p>
        </div>

        <div class=" flex flex-col w-3/6 px-5">
          <h4 class="font-bold text-4xl w-2/6 hover:text-yellow-300 mt-5 mb-3 text-center">SIGN IN</h4>
          <el-form @submit="onSubmit">
            <el-form-item :error="emailError">
              <el-input placeholder="Email Address" v-model="email" size="large" />
            </el-form-item>

            <el-form-item :error="nameError" class="mt-8">
              <el-input placeholder="Password" v-model="password" size="large" type="password" />
            </el-form-item>
              <div class="flex justify-end items-center mb-4 mr-7">
                <a href="#" class="text-blue-500 text-sm">Forgot password?</a>
              </div>
              <el-button size="large" class="mt-3 w-1/6 " :disabled="isSubmitting" type="primary" native-type="submit">Submit</el-button>
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