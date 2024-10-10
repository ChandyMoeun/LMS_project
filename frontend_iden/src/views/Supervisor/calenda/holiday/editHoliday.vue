<template>
    <div class="editHoliday mt-3 pb-10">
      <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
        <router-link to="/calendar">
          <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
          </svg>
        </router-link>
        <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-3/12"><b>Edit Holidays</b></h1>
      </div>
  
      <div class="container mx-auto py-8 mt-3">
        <div class="bg-white shadow-md rounded-lg p-6">
          <!-- Update Form -->
          <form @submit.prevent="updateHoliday">
            <!-- Holiday Name -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="holiday_name" class="text-gray-700 select-none font-medium">Holiday Name</label>
              <input v-model="holidayData.holiday_name" id="holiday_name" type="text" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.holiday_name" class="text-red-500 text-xs mt-1">{{ errors.holiday_name }}</p>
            </div>
  
            <!-- From Date -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="from_date" class="text-gray-700 select-none font-medium">From Date</label>
              <input v-model="holidayData.from_date" id="from_date" type="date" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.from_date" class="text-red-500 text-xs mt-1">{{ errors.from_date }}</p>
            </div>
  
            <!-- To Date -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="to_date" class="text-gray-700 select-none font-medium">To Date</label>
              <input v-model="holidayData.to_date" id="to_date" type="date" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
              <p v-if="errors.to_date" class="text-red-500 text-xs mt-1">{{ errors.to_date }}</p>
            </div>
  
            <!-- Holiday Type -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="holiday" class="text-gray-700 select-none font-medium">Holiday Type</label>
              <select v-model="holidayData.holiday" id="holiday" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <option value="" disabled>Select type</option>
                <option value="national">National</option>
                <option value="observance">Observance</option>
              </select>
              <p v-if="errors.holiday" class="text-red-500 text-xs mt-1">{{ errors.holiday }}</p>
            </div>
  
            <!-- Description -->
            <div class="flex flex-col space-y-2 mb-4">
              <label for="description" class="text-gray-700 select-none font-medium">Description</label>
              <textarea v-model="holidayData.description" id="description" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"></textarea>
              <p v-if="errors.description" class="text-red-500 text-xs mt-1">{{ errors.description }}</p>
            </div>
  
            <!-- Submit Button -->
            <div class="flex justify-center space-x-4 mt-4">
            <button type="submit" class="bg-yellow-400 font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors border-none">
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
      const holidayData = ref({
        holiday_name: '',
        from_date: '',
        to_date: '',
        holiday: '',
        description: ''
      });
  
      const errors = ref({});
      const route = useRoute();
      const router = useRouter();
      
      const updateHoliday = async () => {
        try {
          const response = await axios.put(`/api/calendar_holiday/${route.params.id}`, holidayData.value);
          console.log(response.data);
          router.push('/admin/calendar_holiday');
        } catch (error) {
          if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
          }
        }
      };
  
      return { holidayData, errors, updateHoliday };
    }
  };
  </script>  