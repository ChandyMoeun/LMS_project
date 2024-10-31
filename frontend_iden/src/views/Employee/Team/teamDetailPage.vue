<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky top-0">
            <div class="mt-10 pb-20">
        <div class="container">
          <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <router-link to="/employee/team">
                <svg class="w-6 h-6 mb-3 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-5/12"><b>Employee Profile</b></h1>
          </div>
          <div class="container mt-20 mx-auto p-6">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
              <div class="d-flex justify-content-center pt-5">
                <img :src="employee.profile ? getProfileImage(employee.profile) : getDefaultProfile()" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
              </div>
              <div class="d-flex justify-around gap-4 p-6 mt-3">
                <!-- Left column -->
                <div>
                  <p><strong>Staff ID:</strong> {{ employee.staff_id || '?' }}</p>
                  <p><strong>Name:</strong> {{ employee.full_name }}</p>
                  <p><strong>Gender:</strong> {{ employee.gender }}</p>
                  <p><strong>Date of Birth:</strong> {{ employee.dob }}</p>
                  <p><strong>Position:</strong> {{ employee.position.name }}</p>
                  <p><strong>Department:</strong> {{ employee.department.name }}</p>
                  <p><strong>Roles:</strong>
                    <span v-for="(role, index) in employee.roles" :key="index">
                      {{ role.name }}<span v-if="index < employee.roles.length - 1">, </span>
                    </span>
                  </p>
                </div>
    
                <!-- Right column -->
                <div>
                  <p><strong>Date Joined:</strong> {{ employee.joined_date }}</p>
                  <p><strong>Confirm Date:</strong> {{ employee.entitled_date }}</p>
                  <p><strong>Phone:</strong> 015637286</p>
                  <p><strong>Telegram Number:</strong> 015637286</p>
                  <p><strong>Email:</strong> {{ employee.email }}</p>
                  <p><strong>Line Manager:</strong> {{ employee.manager ? employee.manager.full_name : 'No manager' }}</p>
                  <p><strong>Subline:</strong> XXX</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
          </main>
        </div>
      </div>
    </EmployeeLayout>
  </template>
  
  <script>
  import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
    components: {EmployeeSidebar, WebHeaderMenu},
    data() {
      return {
        employee: {
          staff_id: '',
          full_name: '',
          gender: '',
          dob: '',
          position: { name: '' },
          department: { name: '' },
          roles: [],
          profile: '',
          joined_date: '',
          entitled_date: '',
          email: '',
          manager: { full_name: '' },
        },
      };
    },
    methods: {
      // Returns profile image URL if available
      getProfileImage(profile) {
        return `/images/${profile}`;
      },
      // Fallback to default profile image
      getDefaultProfile() {
        return '/images/default_profile.png';
      },
    },
    mounted() {
      // Simulated API call to fetch employee data
      // In a real app, replace this with an actual API request, e.g., axios.get('/api/employee/{id}')
      this.employee = {
        staff_id: '1234',
        full_name: 'John Doe',
        gender: 'Male',
        dob: '1990-01-01',
        position: { name: 'Manager' },
        department: { name: 'HR' },
        roles: [{ name: 'Admin' }, { name: 'HR Manager' }],
        profile: 'john_doe.jpg',
        joined_date: '2020-06-15',
        entitled_date: '2021-06-15',
        email: 'johndoe@example.com',
        manager: { full_name: 'Jane Smith' },
      };
    },
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