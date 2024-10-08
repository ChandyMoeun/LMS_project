<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu/>
        <main class="bg-gray sticky top-0">
          <RouterView /> 
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script setup lang="ts">
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';

</script>


<style scoped>
.supervisor{
  display: flex;
  height: 100vh;
  align-items: start;
  background-color: #E5E7EB;

  width: 100%;
  
}
.sidebar{
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main{
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #E5E7EB;
  margin-bottom: 50px;
}

</style>