<template>
    <div class="mt-10 pb-10">
        <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
        <router-link to="/calendar">
          <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
          </svg>
        </router-link>
        <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-3/12"><b>Edit Working Days</b></h1>
      </div>
  
      <div class="container mx-auto px-6 py-8 mt-3">
        <div class="bg-white shadow-md rounded-lg p-6">
          <form @submit.prevent="updateWorkday">
            <!-- Work Day -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="work_day" class="text-gray-700 select-none font-medium">Work Day</label>
              <select v-model="workdayData.work_day" id="work_day" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option v-for="day in ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']" :key="day" :value="day">
                  {{ day }}
                </option>
              </select>
              <p v-if="errors.work_day" class="text-red-500 text-xs mt-1">{{ errors.work_day }}</p>
            </div>
  
            <!-- Start Time -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="start_time" class="text-gray-700 select-none font-medium">Start Time</label>
              <input v-model="workdayData.start_time" id="start_time" type="time" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.start_time" class="text-red-500 text-xs mt-1">{{ errors.start_time }}</p>
            </div>
  
            <!-- End Time -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="end_time" class="text-gray-700 select-none font-medium">End Time</label>
              <input v-model="workdayData.end_time" id="end_time" type="time" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.end_time" class="text-red-500 text-xs mt-1">{{ errors.end_time }}</p>
            </div>
  
            <!-- Day Type -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="day_type" class="text-gray-700 select-none font-medium">Day Type</label>
              <select v-model="workdayData.day_type" id="day_type" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option value="full_day">Full Day</option>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
              </select>
              <p v-if="errors.day_type" class="text-red-500 text-xs mt-1">{{ errors.day_type }}</p>
            </div>
  
            <!-- Submit Button -->
            <div class="flex justify-center space-x-4 mt-4">
                <button type="submit" class="bg-yellow-500 font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors border-none">
                  <a href="/calendar" class="no-underline text-white ">Save</a>
                </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  export default {
    setup() {
      const workdayData = ref({
        work_day: '',
        start_time: '',
        end_time: '',
        day_type: ''
      });
  
      const errors = ref({});
      const route = useRoute();
      const router = useRouter();
      
      const updateWorkday = async () => {
        try {
          const response = await axios.put(`/api/calendar_workday/${route.params.id}`, workdayData.value);
          console.log(response.data);
          router.push('/admin/calendar_workday');
        } catch (error) {
          if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
          }
        }
      };
  
      return { workdayData, errors, updateWorkday };
    }
  };
  </script>
  