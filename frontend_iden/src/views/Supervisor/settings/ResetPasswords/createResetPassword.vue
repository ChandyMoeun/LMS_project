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
            <div class="flex text-black my-5" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/supervisor/settings">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" >
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold mr-20 text-3xl px-8 w-2/6 mt-3 hover:text-yellow-500">
                <b>Change My Password</b>
              </h1>
            </div>
            <div class="password-change-container bg-white border rounded-lg shadow">
              <form @submit.prevent="changePassword" class="p-5">
                <input type="password" v-model="currentPassword" placeholder="Current password" required class="password-input" />
                <span v-if="currentPasswordError" class="error">{{ currentPasswordError }}</span>

                <input type="password" v-model="newPassword" placeholder="New password" required class="password-input" />
                <span v-if="newPasswordError" class="error">{{ newPasswordError }}</span>

                <input type="password" v-model="confirmPassword" placeholder="Repeat the new password" required class="password-input" />
                <span v-if="confirmPasswordError" class="error">{{ confirmPasswordError }}</span>

                <button type="submit" :disabled="!isFormValid" class="change-password-button bg-gray-900 hover:bg-yellow-500 py-2" >
                  <i class="fa fa-key" aria-hidden="true"></i> Change Now
                </button>
              </form>
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
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default {
    components: { SupervisorSidebar, WebHeaderMenu },
    data() {
      return {
        currentPassword: '',
        newPassword: '',
        confirmPassword: '',
        currentPasswordError: '',
        newPasswordError: '',
        confirmPasswordError: '',
        correctCurrentPassword: 'known_password'  // Replace with the actual current password or use an API call for validation
      };
    },
    computed: {
      isFormValid() {
        return (
          this.currentPassword &&
          this.currentPassword === this.correctCurrentPassword &&
          this.newPassword &&
          this.newPassword.length >= 8 &&
          this.newPassword === this.confirmPassword
        );
      }
    },
    watch: {
      currentPassword(value) {
        if (!value) {
          this.currentPasswordError = 'Current password is required';
        } else if (value !== this.correctCurrentPassword) {
          this.currentPasswordError = 'Current password is incorrect';
        } else {
          this.currentPasswordError = '';
        }
      },
      newPassword(value) {
        if (value.length < 8) {
          this.newPasswordError = 'New password must be at least 8 characters';
        } else {
          this.newPasswordError = '';
        }
      },
      confirmPassword(value) {
        this.confirmPasswordError = 
          value !== this.newPassword ? 'Passwords do not match' : '';
      }
    },
    methods: {
      changePassword() {
        if (this.isFormValid) {
          // Handle the password change logic here, possibly calling an API to update the password
          alert('Password changed successfully!');
          this.resetForm();
        }
      },
      resetForm() {
        this.currentPassword = '';
        this.newPassword = '';
        this.confirmPassword = '';
      }
    }
  }
</script>
  
<style scoped>
.password-input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
  }
  .change-password-button {
    width: 10%;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  .change-password-button:disabled {
    cursor: not-allowed;
  }
  .error {
    color: red;
    font-size: 0.875rem;
    margin-bottom: 10px;
    display: block;
  }
</style>