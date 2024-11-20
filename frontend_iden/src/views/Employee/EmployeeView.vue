<template>
  <EmployeeLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <main class="bg-gray">
        <h1>here is my Employee page</h1>
        <h2>hello world</h2>
      </main>
    </div>
  </EmployeeLayout>
</template>

<script setup lang="ts">
import EmployeeLayout from '@/Components/Layouts/EmployeeLayout.vue'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
</script>      