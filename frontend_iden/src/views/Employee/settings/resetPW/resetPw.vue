<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="px-10">
            <div class="text-black mt-5" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/employee/settings">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl px-8 w-2/6 mt-3 hover:text-yellow-400">
                <b>Change My Password</b>
              </h1>
            </div>
            <div class="password-change-container bg-white border mt-10 rounded-lg shadow">
              <form @submit.prevent="changePassword" class="p-5">
                <input type="password" v-model="currentPassword" placeholder="Current password" required class="password-input" @blur="validateCurrentPassword"/>
                <span v-if="currentPasswordError" class="error">{{ currentPasswordError }}</span>

                <input type="password" v-model="newPassword" placeholder="New password" required class="password-input" @blur="validateNewPassword"/>
                <span v-if="newPasswordError" class="error">{{ newPasswordError }}</span>

                <input type="password" v-model="confirmPassword" placeholder="Repeat the new password" required class="password-input" @blur="validateConfirmPassword"/>
                <span v-if="confirmPasswordError" class="error">{{ confirmPasswordError }}</span>
                
                <button type="submit" :disabled="!isFormValid" class="bg-gray-900 border-none rounded-lg shadow text-white hover:bg-yellow-500">
                  Reset now
                </button>
              </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue';
export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
      currentPasswordError: '',
      newPasswordError: '',
      confirmPasswordError: '',
    };
  },
  computed: {
    isFormValid() {
      return (
        this.currentPassword &&
        this.newPassword &&
        this.newPassword.length >= 8 &&
        this.newPassword === this.confirmPassword &&
        !this.currentPasswordError &&
        !this.newPasswordError &&
        !this.confirmPasswordError
      );
    },
  },
  methods: {
    async validateCurrentPassword() {
      if (!this.currentPassword) {
        this.currentPasswordError = 'Current password is required';
        return;
      }
      try {
        // Send the current password to the backend to validate
        const response = await axiosInstance.post('/validate-password', {
          current_password: this.currentPassword,
        });

        if (response.data.success) {
          this.currentPasswordError = ''; // Password matches
        } else {
          this.currentPasswordError = 'Password does not match';
        }
      } catch (error) {
        console.error('Error validating password:', error);
        this.currentPasswordError = 'Error validating password';
      }
    },
    validateNewPassword() {
      if (this.newPassword.length < 8) {
        this.newPasswordError = 'New password must be at least 8 characters';
      } else {
        this.newPasswordError = '';
      }
    },
    validateConfirmPassword() {
      if (this.confirmPassword !== this.newPassword) {
        this.confirmPasswordError = 'Passwords do not match';
      } else {
        this.confirmPasswordError = '';
      }
    },
    async changePassword() {
      try {
        const response = await axiosInstance.post('/me', {
          current_password: this.currentPassword,
          new_password: this.newPassword,
        });
        if (response.data.success) {
          alert('Password changed successfully!');
          this.resetForm();
        } else {
          alert(response.data.message || 'Error changing password');
        }
      } catch (error) {
        console.error('Error changing password:', error);
      }
    },
    resetForm() {
      this.currentPassword = '';
      this.newPassword = '';
      this.confirmPassword = '';
      this.currentPasswordError = '';
      this.newPasswordError = '';
      this.confirmPasswordError = '';
    },
  },
};
</script>

<style scoped>
.password-input {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ddd;
}
.error {
  color: red;
  font-size: 0.875rem;
  margin-bottom: 10px;
  display: block;
}
</style>