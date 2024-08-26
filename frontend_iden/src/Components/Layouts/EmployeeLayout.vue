<script setup lang="ts">
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue';
</script>
<template>
  <EmployeeNavbar />
  <div class="h-full">
    <div class="h-full">
      <slot />
    </div>
  </div>
</template>

