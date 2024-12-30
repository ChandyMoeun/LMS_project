<script setup lang="ts">
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
</script>
<template>
  <EmployeeSidebar />
  <div class="h-full">
    <div class="h-full">
      <slot />
    </div>
  </div>
</template>

