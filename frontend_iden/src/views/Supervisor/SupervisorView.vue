<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <main class="bg-gray">
        <h1>here is my supervisor page</h1>
        <h2>hello world</h2>
      </main>
    </div>
  </SupervisorLayout>
</template>

<script setup lang="ts">
import SupervisorLayout from '@/Components/Layouts/SupervisorLayout.vue'
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
</script>


<style scoped>
.supervisor{
  display: flex;
  height: 100vh;
  /* flex-direction: column; */
  justify-content: space-between;
  align-items: center;
  background-color: #f5f5f5;
  width: 100%;
  
}
.sidebar{
  width: 300px;
  height: 100vh;
  background-color: #040405;
  color: white;
  /* padding: 10px; */
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
main{
  /* padding: 20px; */
  height: 100vh;
  width: 100%;
  background-color: rgb(231, 215, 215);

}

</style>