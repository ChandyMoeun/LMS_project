<script setup lang="ts">
import { Icon } from '@iconify/vue'
// import { ref, computed, watchEffect } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'

// const showDropdown = ref(false)
const route = useRoute()
const router = useRouter()

function logOut() {
  localStorage.removeItem('access_token')
  router.push('/')
  window.location.reload()
}
</script>
<template>
  <header class="flex justify-between px-50 py-3 bg-white items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <Icon icon="skill-icons:devto-dark" style="font-size: 45px" />
      <span class="text-xl font-bold">I-KNOW</span>
    </div>

    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        href="/post"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Post</a
      >
      <a
        href="/team"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Team</a
      >
      <a
        href="/projects"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Projects</a
      >
      <a
        href="/reports"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Reports</a
      >
    </nav>

    <!--logout-->
    <div>
      <div class="px-4 py-2 rounded font-semibold" @click="logOut">Logout</div>
    </div>
  </header>
</template>
