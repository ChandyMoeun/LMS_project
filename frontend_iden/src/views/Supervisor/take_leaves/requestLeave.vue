  <template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky top-0">
            <div class="mt-5 pb-20">
              <div class="flex text-black " style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
                <router-link to="/Supervisor/takeLeave">
                  <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                  </svg>
                </router-link>
                <h1 class="font-bold mr-20 text-3xl px-8 w-3/12 mt-3 hover:text-yellow-400"><b>Request Leave</b></h1>
              </div>
              <h1>hello guy </h1>
            </div> 
          </main>
        </div>
      </div>
    </SupervisorLayout>
  </template>
  
  <script>
 
  </script>
  <style scoped>
  .supervisor {
    display: flex;
    height: 100vh;
    align-items: start;
    width: 100%;
  }
  .sidebar {
    width: 17%;
    height: auto;
  }
  .container-page {
    width: 83%;
  }
  main {
    padding: 50px 50px 0px 50px;
    height: auto;
    width: 100%;
    background-color: #EEEDED;
    margin-bottom: 50px;
  }
  </style>