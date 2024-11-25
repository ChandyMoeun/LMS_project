<template>
  <EmployeeLayout>
    <div class="employee flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page w-[83%]">
        <EmployeeNavbar/>
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="px-10">
            <div class="text-black mt-10" style="display: flex; flex-direction: column; border-bottom: solid 1px gray">
              <router-link to="/employee/settings">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl mb-3 px-3 hover:text-yellow-500 w-2/12">My Profile</h1>
            </div>
            <div class="container mx-auto px-6 py-8">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                  <div class="flex text-gray-500 mb-3 justify-center">
                      <div class="bg-white rounded-lg">
                          <div class="text-center uppercase font-bold mb-2">
                              <label for="thumbnailprev" class="cursor-pointer text-blue-600 hover:text-blue-400">
                              Change Profile Picture
                              </label>
                              <input type="file" id="thumbnailprev" class="hidden" @change="updatePreview" accept="image/*" />
                          </div>
                          <!-- Display the profile image -->
                          <img :src="previewUrl || profileUrl" alt="Profile Image" class="shadow-lg rounded-full mt-4 border-none h-40 w-40 object-cover mx-auto"/>
                      </div>
                  </div>
                  <div class="flex flex-col space-y-2">
                    <label for="full_name" class="text-gray-700 select-none font-medium">Full Name</label>
                    <input id="full_name" type="text" v-model="form.full_name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>
                  <div class="flex flex-col mt-3 space-y-2">
                    <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                    <input id="email" type="email" v-model="form.email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue';
export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  data() {
    return {
      form: {
        full_name: '',
        email: '',
      },
      profileUrl: '', // URL for the profile image
      previewUrl: '', // For image preview
      selectedFile: null, // Holds the uploaded image file
    };
  },
  async mounted() {
    await this.fetchUserData(); // Fetch user data when the component is mounted
  },
  methods: {
    async fetchUserData() {
      try {
        const response = await axiosInstance.get('/me');
        const userData = response.data.data;
        this.form.full_name = userData.full_name;
        this.form.email = userData.email;
        // Construct the profile image URL
        if (userData.profile) {
          this.profileUrl = `http://127.0.0.1:8000/images/${userData.profile}`;
          }
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    },
    updatePreview(event) {
      const file = event.target.files[0];
      if (file) {
        this.previewUrl = URL.createObjectURL(file);
        this.selectedFile = file; // Store the selected file
      }
    },
    async handleSubmit() {
      try {
        const formData = new FormData();
        formData.append('full_name', this.form.full_name);
        formData.append('email', this.form.email);
        if (this.selectedFile) {
          formData.append('profile', this.selectedFile);
        }
        const response = await axiosInstance.post('/me', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        console.log('Profile updated successfully:', response.data);
      } catch (error) {
        console.error('Error updating profile:', error);
      }
    },
  },
};
</script>