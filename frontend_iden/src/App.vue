<!-- <script setup lang="ts"></script>

<template>
  <RouterView />
</template> -->

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
  background-color: #f5f5f5;
  width: 100%;
  
}
.sidebar{
  width: 15%;
  height: 100vh;
  background-color: #040405;
  color: white;
}
.container-page {
  width: 85%;
}
main{
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: rgb(231, 215, 215);
}

</style>