<template>
  
    <div
      class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white"
      style="width: 100%; height: 100vh;"
    >
      <h4 class="text-center mb-4">Supervisor Dashboard</h4>
      <hr />
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="/" class="nav-link text-white active" aria-current="page">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="/calendar" class="nav-link text-white">
            <i class="bi bi-calendar-check me-2"></i> Calendar
          </a>
        </li>
        <li>
          <a href="leave" class="nav-link text-white"> <i class="bi bi-info-circle me-2"></i> Leave </a>
        </li>
      </ul>
    </div>

</template>

<script setup lang="ts">
import { ref, computed, watchEffect } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'
</script>

<style scoped>
</style>