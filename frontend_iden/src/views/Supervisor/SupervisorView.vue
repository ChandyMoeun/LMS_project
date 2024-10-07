<template>
 
  <div>

    <h1>here is my supervisor page</h1>
    <h2>hello world</h2>
  </div>
       
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