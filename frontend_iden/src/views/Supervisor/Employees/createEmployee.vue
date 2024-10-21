<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu/>
        <main class="bg-gray sticky top-0">
          <div class="mt-10">
        <div class="container flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
          <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
            <router-link to="/Supervisor/Employee">
              <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
            </router-link>
            <h1 class="font-bold text-gray-900 mr-20 w-3/12 text-3xl mt-4 hover:text-yellow-400"><b>Add Employee </b></h1>
          </div>
          <div class="bg-white shadow-md rounded my-6 mt-20 p-10">
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
              <div class="flex flex-col items-center mb-4">
                <div class="relative">
                  <img
                    :src="profileImage"
                    alt="Profile Picture"
                    class="w-30 h-30 rounded-full object-cover cursor-pointer"
                    @click="triggerFileUpload"
                  />
                  <input type="file" ref="profile" @change="handleProfileChange" class="hidden"/>
                </div>
                <label class="text-gray-700 font-medium mb-2 cursor-pointer" for="profile">Update Profile</label>
              </div>
  
              <div class="flex justify-between w-full">
                <div class="w-1/2 pr-4">
                  <!-- Staff ID -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="staff_id">Staff ID</label>
                    <input type="text" v-model="form.staff_id" placeholder="Enter Staff ID" class="px-4 py-2 rounded-lg border border-gray-300" />
                  </div>
  
                  <!-- Full Name -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="full_name">Full Name</label>
                    <input type="text" v-model="form.full_name" placeholder="Enter Full Name" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
  
                  <!-- Gender -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="gender">Gender</label>
                    <select v-model="form.gender" class="px-4 py-2 rounded-lg border border-gray-300">
                      <option disabled>Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
  
                  <!-- Email -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700">Email</label>
                    <input type="email" v-model="form.email" placeholder="Enter Email" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
  
                  <!-- Password -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700">Password</label>
                    <input type="password" v-model="form.password" placeholder="Enter Password" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
                </div>
  
                <div class="w-1/2 pl-4">
                  <!-- Confirm Password -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="password_confirmation">Confirm Password</label>
                    <input type="password" v-model="form.password_confirmation" placeholder="Re-enter Password" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
  
                  <!-- Date of Birth -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="dob">Date of Birth</label>
                    <input type="date" v-model="form.dob" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
  
                  <!-- Joined Date -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="joined_date">Joined Date</label>
                    <input type="date" v-model="form.joined_date" class="px-4 py-2 rounded-lg border border-gray-300"/>
                  </div>
  
                  <!-- Position -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="position_id">Position</label>
                    <select v-model="form.position_id" class="px-4 py-2 rounded-lg border border-gray-300">
                      <option disabled>Select Position</option>
                      <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                    </select>
                  </div>
  
                  <!-- Department -->
                  <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 ml-3" for="department_id">Department</label>
                    <select v-model="form.department_id" class="px-4 py-2 rounded-lg border border-gray-300">
                      <option disabled>Select Department</option>
                      <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                    </select>
                  </div>
                </div>
              </div>
  
              <!-- Role Assignment -->
              <h3 class="text-xl my-4 text-gray-600">Role</h3>
              <div class="grid grid-cols-3 gap-4">
                <div v-for="role in roles" :key="role.id" class="flex flex-col justify-center">
                  <label class="inline-flex items-center mt-3">
                    <input type="checkbox" v-model="form.roles" :value="role.id" class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">{{ role.name }}</span>
                  </label>
                </div>
              </div>
  
              <!-- Submit Buttons -->
              <div class="flex justify-center text-center mt-16 gap-3 mb-16">
                <button @click="cancel" class="w-1/12 mt-5 bg-red-500 border-none rounded-lg text-white font-bold py-1 px-2 hover:bg-red-400 transition-colors">Cancel</button>
                <button @ckick="submitForm" type="submit" class="w-1/12 mt-5 bg-gray-900 border-none rounded-lg text-white font-bold py-2 px-4 hover:bg-yellow-500 transition-colors">Add</button>
              </div>
            </form>
          </div>
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
  components: {SupervisorSidebar, WebHeaderMenu},
    data() {
      return {
        form: {
          staff_id: '',
          full_name: '',
          gender: '',
          email: '',
          password: '',
          password_confirmation: '',
          dob: '',
          joined_date: '',
          position_id: '',
          department_id: '',
          roles: [],
        },
        positions: [], // Assume fetched from API or props
        departments: [], // Assume fetched from API or props
        roles: [], // Assume fetched from API or props
        profileImage: '', // Profile image path
      };
    },
    methods: {
      // Trigger profile image file input
      triggerFileUpload() {
        this.$refs.profile.click();
      },
  
      // Update the profile image preview
      handleProfileChange(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.profileImage = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      },
  
      // Submit form logic
      submitForm() {
        // API call to update employee data
        // e.g., axios.post or fetch logic here
        this.$router.push('/Supervisor/Employee')
      },
  
      cancel() {
        this.$router.push('/Supervisor/Employee');
      },
    },
    mounted() {
      // Example of fetching employee data to populate form (assumed API call)
      // axios.get('/api/employee/{id}').then(response => {
      //   this.form = response.data;
      // });
    },
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