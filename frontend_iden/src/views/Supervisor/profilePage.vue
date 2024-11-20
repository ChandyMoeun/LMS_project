<template>
    <SupervisorLayout>
      <div class="supervisor">
        <div class="sidebar">
          <SupervisorSidebar></SupervisorSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
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
                    <div class="flex text-gray-500 mt-5">
                        <div class="bg-white rounded-lg">
                            <div class="text-center uppercase text-bold">
                                <label for="thumbnailprev" class="cursor-pointer">Upload a file</label>
                                <input type="file" id="thumbnailprev" class="hidden" @change="updatePreview" />
                            </div>
                            <img src="../../assets/image/profile-avatar.jpg" alt="Profile Image" class="shadow-lg rounded-full max-w-full mt-4 mr-6 h-auto align-middle border-none h-40 w-40 object-cover" />
                            <button type="button" @click="clearPreview">Change</button>
                        </div>
                    </div>
                    <div class="text-center mb-16">
                        <button type="submit" class="bg-blue-600 border-none text-white font-bold px-3 py-1 rounded focus:outline-none shadow hover:bg-yellow-500 transition-colors">
                        Update
                        </button>
                    </div>
                    </form>
                </div>
            </div>
          </main>
        </div>
      </div>
    </SupervisorLayout>
  </template>
  
<script>
 import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
 import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
    components: { SupervisorSidebar, WebHeaderMenu },
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