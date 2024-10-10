<template>
  <div class="p">
    <div class="text-black px-8 m-6 items-right" style="display: flex; flex-direction: column; border-bottom: solid 1px;">
      <router-link to="/calendar">
        <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
        </svg>
      </router-link>
      <h1 class="font-bold border-b-2 text-3xl mt-3 hover:text-yellow-400 w-3/12"><b>Add Holidays</b></h1>
    </div>
    <div class="container mx-auto px-6 py-8 mt-3">
      <div class="bg-white shadow-md rounded-lg p-6">
        <form @submit.prevent="submitForm">
          <!-- Holiday Name -->
          <div class="flex flex-col space-y-2 mb-4">
            <label for="holiday_name" class="text-gray-700 select-none font-medium">Holiday Name</label>
            <input v-model="formData.holiday_name" id="holiday_name" type="text" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            <p v-if="errors.holiday_name" class="text-red-500 text-xs mt-1">{{ errors.holiday_name }}</p>
          </div>

          <!-- From Date -->
          <div class="flex flex-col space-y-2 mb-4">
            <label for="from_date" class="text-gray-700 select-none font-medium">From Date</label>
            <input v-model="formData.from_date" id="from_date" type="date" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            <p v-if="errors.from_date" class="text-red-500 text-xs mt-1">{{ errors.from_date }}</p>
          </div>

          <!-- To Date -->
          <div class="flex flex-col space-y-2 mb-4">
            <label for="to_date" class="text-gray-700 select-none font-medium">To Date</label>
            <input v-model="formData.to_date" id="to_date" type="date" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            <p v-if="errors.to_date" class="text-red-500 text-xs mt-1">{{ errors.to_date }}</p>
          </div>

          <!-- Holiday Type -->
          <div class="flex flex-col space-y-2 mb-4">
            <label for="holiday" class="text-gray-700 select-none font-medium">Holiday Type</label>
            <select v-model="formData.holiday" id="holiday" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              <option disabled value="">Select type</option>
              <option value="national">National</option>
              <option value="observance">Observance</option>
            </select>
            <p v-if="errors.holiday" class="text-red-500 text-xs mt-1">{{ errors.holiday }}</p>
          </div>

          <!-- Description -->
          <div class="flex flex-col space-y-2 mb-4">
            <label for="description" class="text-gray-700 select-none font-medium">Description</label>
            <textarea v-model="formData.description" id="description" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"></textarea>
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
export default {
  data() {
    return {
      formData: {
        holiday_name: '',
        from_date: '',
        to_date: '',
        holiday: '',
        description: ''
      },
      errors: {}
    };
  },
  methods: {
    async submitForm() {
      // Reset errors
      this.errors = {};

      // Here, you'd replace with your actual API endpoint 
      try {
        const response = await fetch('/admin/calendar_holiday/store', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.formData)
        });

        const result = await response.json();

        if (!response.ok) {
          // If validation fails, Laravel typically sends a 422 response with errors.
          this.errors = result.errors || {};
        } else {
          // Handle successful form submission (e.g., navigate to another page, show success message, etc.)
          this.$router.push('/admin/calendar_workday');
        }
      } catch (error) {
        console.error('Form submission error:', error);
      }
    }
  }
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
