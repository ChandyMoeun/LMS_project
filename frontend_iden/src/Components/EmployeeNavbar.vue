<script setup lang="ts">
import { ref, computed, watchEffect, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'
import { useNotificationStore } from '@/stores/notification'
import { storeToRefs } from 'pinia'

const authStore = useAuthStore()
const user = authStore.user
const roles = authStore.roles
const permissions = authStore.permissions
const isAuthenticated = authStore.isAuthenticated

const showDropdown = ref(false)
const route = useRoute()
const router = useRouter()
const index = ref<string>('1')

// Get the notification store
const notificationStore = useNotificationStore()

// Destructure notifications from the store
const { notifications } = storeToRefs(notificationStore)

// Fetch notifications when component mounts
onMounted(() => {
  notificationStore.fetchNotifications()
})
// Handle notification click to clear notifications
const handleNotificationClick = () => {
  if (notifications.value > 0) {
    notificationStore.clearNotifications()
  }
}

function toggleDropdown() {
  showDropdown.value = !showDropdown.value
}

function closeDropdown() {
  showDropdown.value = false
}

function logOut() {
  localStorage.removeItem('access_token')
  router.push('/login')
}

const tabs = [{ id: 1, name: 'Dashboard', path: '/supervisor_dashboard' }]

const activeTab = computed(() => {
  return tabs.findIndex((tab) => route.path.includes(tab.path))
  // user,
  // roles,
  // permissions,
  // isAuthenticated
})

// watchEffect(() => {
//   if (activeTab.value === -1) {
//     router.push(tabs[0].path)
//   }
// })
</script>

<template>
  <header
    class="flex justify-between items-center py-1 px-12 fixed w-10/12 z-50"
    style="background: #ffda03"
  >
    <div class="flex w-full items-center justify-between px-4 py-1">
      <div class="relative mx-4 lg:mx-0">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
            <path
              d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></path>
          </svg>
        </span>
        <input
          class="form-input w-32 h-9 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
          type="text"
          placeholder="Search"
        />
      </div>
      <!-- Right elements -->
      <div class="flex items-center space-x-4">
        <!-- Notification Bell Icon -->
        <div class="relative flex items-center gap-3 pr-5">
          <router-link
            to="/employee/dashboard"
            class="relative flex items-center"
            @click="handleNotificationClick"
          >
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 20 21"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C17 15.4 17 16 16.462 16H3.538C3 16 3 15.4 3 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 10 3.464ZM1.866 8.832a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M6.54 16a3.48 3.48 0 0 0 6.92 0H6.54Z"
              />
            </svg>
            <span
              v-if="notifications >= 0"
              class="absolute -top-2 -right-2 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full"
            >
              {{ notifications }}
            </span>
          </router-link>
          <span
            >Welcome, <strong>{{ user.full_name }}</strong></span
          >
        </div>
        <!-- User Avatar -->
        <div class="relative">
          <a
            class="flex items-center whitespace-nowrap transition duration-150 ease-in-out"
            href="#"
            @click="toggleDropdown"
            role="button"
            aria-expanded="false"
          >
            <img
              :src="`http://127.0.0.1:8000/images/${user.profile}`"
              class="rounded-full h-12 w-12 border-2 border-white w-12 h-11 shadow-lg"
              alt=""
              loading="lazy"
            />
          </a>
          <!-- Dropdown menu -->
          <transition name="fade">
            <div
              v-if="showDropdown"
              class="absolute right-7 z-50 mt-10 w-45 text-center rounded-lg bg-gray-100 shadow-lg dark:bg-neutral-800"
            >
              <a
                href="/employee/settings/profile"
                class="block no-underline w-full px-4 py-2 text-sm text-neutral-700 hover:bg-blue-600 hover:text-white dark:text-white dark:hover:bg-neutral-700 cursor-pointer"
                >My profile</a
              >
              <div
                class="block w-full px-4 py-2 text-sm text-neutral-700 hover:bg-blue-600 hover:text-white dark:text-white dark:hover:bg-neutral-700 cursor-pointer"
                @click="logOut"
              >
                Log out
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>
  </header>
</template>

<style scoped>
nav {
  padding: 0 20px;
  position: sticky;
  top: 0;
  z-index: 50;
}
.tab-container {
  position: relative;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  padding: 10px;
  color: white;
  border-radius: 9px;
  height: 60px;
}

.indicator {
  content: '';
  width: 150px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  position: absolute;
  top: 10px;
  z-index: 9;
  border: 1px solid rgba(255, 255, 255, 0.4);
  box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.12), 0px 3px 1px rgba(0, 0, 0, 0.04);
  border-radius: 7px;
  transition: all 0.2s ease-out;
}

.tab {
  width: 150px;
  height: 40px;
  position: absolute;
  z-index: 99;
  outline: none;
  opacity: 0;
}

.tab_label {
  width: 150px;
  height: 40px;
  position: relative;
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 0;
  font-size: 1rem;
  opacity: 0.8;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
}
input {
  color: white;
}
a:hover {
  color: #f1f1f1;
}
</style>
