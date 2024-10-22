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
  .supervisor{
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

<!-- <template>
    <div>
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
          <h3 class="text-gray-700 text-3xl font-medium">Welcome: {{ user.full_name }}</h3>
          <div class="bg-white shadow-md rounded my-6 p-5">
            <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
              <div class="flex flex-col space-y-2">
                <label for="full_name" class="text-gray-700 select-none font-medium">Full Name</label>
                <input v-model="form.full_name" id="full_name" type="text" placeholder="Enter name"
                       class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              </div>
  
              <div class="flex flex-col space-y-2">
                <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                <input v-model="form.email" id="email" type="email" placeholder="Enter email"
                       class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              </div>
  
              <div class="flex text-gray-500 mt-5">
                <div class="bg-white rounded-lg">
                  <div v-if="!previewUrl && !imgurl" class="text-center uppercase text-bold">
                    <label for="thumbnailprev" class="cursor-pointer">Upload a file</label>
                    <input type="file" id="thumbnailprev" class="hidden" @change="updatePreview" />
                  </div>
  
                  <div v-if="previewUrl" class="relative w-24 h-24">
                    <img :src="previewUrl" alt="Profile Image"
                         class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover" />
                    <button type="button" @click="clearPreview">Change</button>
                  </div>
  
                  <div v-if="imgurl && !previewUrl" class="relative w-24 h-24">
                    <img :src="imgurl" alt="Profile Image"
                         class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover" />
                    <button type="button" @click="clearPreview">Change</button>
                  </div>
                </div>
              </div>
  
              <div class="text-center mt-16 mb-16">
                <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        full_name: '', // Assuming full name is preloaded
        email: '' // Assuming email is preloaded
      },
      previewUrl: '',
      imgurl: `/images/${this.$store.state.user.profile}`, // Get image URL from the store or initial props
    };
  },
  methods: {
    updatePreview(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.previewUrl = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    clearPreview() {
      this.previewUrl = '';
      this.imgurl = '';
      document.getElementById('thumbnailprev').value = null; // Clear file input
    },
    async handleSubmit() {
      try {
        const formData = new FormData();
        formData.append('full_name', this.form.full_name);
        formData.append('email', this.form.email);

        const fileInput = document.getElementById('thumbnailprev');
        if (fileInput.files[0]) {
          formData.append('profile', fileInput.files[0]);
        }

        const response = await axios.post('/api/admin/profile/update', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });

        if (response.data.success) {
          // Handle success (e.g., update user profile)
          alert('Profile updated successfully!');
        }
      } catch (error) {
        console.error('Error during update:', error);
        alert('Profile update failed.');
      }
    },
  },
  mounted() {
    // Fetch user data and initialize form fields if necessary
    this.form.full_name = this.$store.state.user.full_name;
    this.form.email = this.$store.state.user.email;
  },
};
</script> -->
  