<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <EmployeeNavbar/>
          <main class="sticky flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="text-black mt-10" style="display: flex; flex-direction: column; border-bottom: solid 1px gray" >
              <router-link to="/employee/settings">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" > 
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold px-8 text-3xl px-8 w-2/6 hover:text-yellow-500">
                <b>My Profile</b>
              </h1>
            </div>
            <div class="container mx-auto px-6 py-8">
                <div class="bg-white shadow-md rounded my-6 p-5">
                  <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="flex text-gray-500 mt-3 mb-5 justify-center">
                        <div class="bg-white rounded-lg">
                            <div class="text-center uppercase text-bold">
                                <label for="thumbnailprev" class="cursor-pointer">Upload a file</label>
                                <input type="file" id="thumbnailprev" class="hidden" @change="updatePreview" />
                            </div>
                            <img src="../../assets/image/profile-avatar.jpg" alt="Profile Image" class="shadow-lg rounded-full max-w-full mt-4 mr-6 h-auto align-middle border-none h-40 w-40 object-cover" />
                            <button type="button" @click="clearPreview">Change</button>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="full_name" class="text-gray-700 select-none font-medium">Full Name</label>
                        <input  id="full_name" type="text" placeholder="Dara"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                        <input id="email" type="email" placeholder="Dara"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    </div>
                  </form>
                </div>
            </div>
          </main>
        </div>
      </div>
    </EmployeeLayout>
  </template>
  
<script>
 import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
 import EmployeeNavbar from '@/Components/EmployeeNavbar.vue';
  export default {
    components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      form: {
        full_name: '', // Assuming full name is preloaded
        email: '' // Assuming email is preloaded
      },
    };
  },
  methods:{
    clearPreview() {
      this.previewUrl = '';
      this.imgurl = '';
      document.getElementById('thumbnailprev').value = null; // Clear file input
    },
  }
};
  </script>
  
  
  <style scoped>
  .employee{
    display: flex;
    height: 100vh;
    align-items: start;
    width: 100%;
    background-color: #E5E7EB;
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