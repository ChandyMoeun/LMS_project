<template>
  <div
    class="login-container min-h-screen flex items-center justify-center flex-col bg-gray-100"
    style="background-color: #ececec"
  >
    <div class="login-card w-full max-w-md bg-white rounded-lg shadow-lg flex overflow-hidden flex-row">
      <!-- Left section with image -->
      <div class="login-image flex flex-col justify-center">
        <img :src="loginImage" alt="Login Illustration" class="object-cover" />
        <p class="text-sm text-center mt-4" style="color: #b7b7b7">
          Sign in here to join iDEN leave management system.
        </p>
      </div>

      <!-- Right section with form -->
      <div class="login-form p-6 flex-grow">
        <h2 class="text-center text-2xl mb-10"><b>SIGN IN</b></h2>

        <el-form :model="form" :rules="rules" ref="loginForm" @submit.native.prevent="onSubmit">
          <el-form-item prop="email">
            <el-input
              v-model="form.email"
              placeholder="Enter your email"
              size="large"
              type="email"
            />
          </el-form-item>

          <el-form-item prop="password">
            <el-input
              v-model="form.password"
              placeholder="Enter your password"
              size="large"
              ype="password"
            />
          </el-form-item>

          <div class="flex justify-between mt-4">
            <el-button type="primary" class="w-full" @click="onSubmit"> Sign In </el-button>
          </div>
          <p class="mt-4 text-sm text-right">
            <a href="#" class="text-blue-500">Forgot password?</a>
          </p>
        </el-form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      rules: {
        email: [
          { required: true, message: 'Please input your email', trigger: 'blur' },
          { type: 'email', message: 'Please input a valid email', trigger: 'blur' }
        ],
        password: [{ required: true, message: 'Please input your password', trigger: 'blur' }]
      },
    }
  },
  methods: {
    onSubmit() {
      this.$refs.loginForm.validate((valid) => {
        if (valid) {
          alert('Login successful')
        } else {
          console.log('Error in form submission')
          return false
        }
      })
    }
  }
}
</script>

<style>

</style>
