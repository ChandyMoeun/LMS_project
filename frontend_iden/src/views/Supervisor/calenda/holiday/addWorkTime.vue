<template>
    <main class="mt-10 p-5">
      <div class="d-flex border-b-2 border-gray-300 m-5 px-8 h-15 items-center">
        <router-link to="/admin/calendar_workday">
          <svg class="w-6 h-6 mt-3 text-gray-800 hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l4 4M1 5l4-4" />
          </svg>
        </router-link>
        <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-2/6"><b>Add Working Days</b></h1>
      </div>
      <div class="container mx-auto px-6 py-8 mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
          <form @submit.prevent="handleSubmit">
            <!-- Work Day -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="work_day" class="text-gray-700 select-none font-medium">Work Day</label>
              <select v-model="formData.work_day" id="work_day" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option value="" disabled>Select a day</option>
                <option v-for="day in days" :key="day" :value="day">{{ day }}</option>
              </select>
              <p v-if="errors.work_day" class="text-red-500 text-xs mt-1">{{ errors.work_day }}</p>
            </div>
  
            <!-- Start Time -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="start_time" class="text-gray-700 select-none font-medium">Start Time</label>
              <input v-model="formData.start_time" type="time" id="start_time" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.start_time" class="text-red-500 text-xs mt-1">{{ errors.start_time }}</p>
            </div>
  
            <!-- End Time -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="end_time" class="text-gray-700 select-none font-medium">End Time</label>
              <input v-model="formData.end_time" type="time" id="end_time" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.end_time" class="text-red-500 text-xs mt-1">{{ errors.end_time }}</p>
            </div>
  
            <!-- Day Type -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="day_type" class="text-gray-700 select-none font-medium">Day Type</label>
              <select v-model="formData.day_type" id="day_type" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option value="" disabled>Select type</option>
                <option value="full_day">Full Day</option>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
              </select>
              <p v-if="errors.day_type" class="text-red-500 text-xs mt-1">{{ errors.day_type }}</p>
            </div>
  
            <!-- Submit Button -->
            <div class="flex justify-center space-x-4 mt-4">
              <button type="submit" class="bg-yellow-400 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors">
                Add
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: {
          work_day: "",
          start_time: "",
          end_time: "",
          day_type: ""
        },
        errors: {},
        days: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
      };
    },
    methods: {
      async handleSubmit() {
        try {
          // Make your form submission logic here
          // For example, using Axios to post data
          // await axios.post('/api/your-endpoint', this.formData);
          
          // Clear errors after successful submission
          this.errors = {};
        } catch (error) {
          // If there's an error, populate the errors object
          this.errors = error.response.data.errors || {};
        }
      }
    }
  };
  </script>
  