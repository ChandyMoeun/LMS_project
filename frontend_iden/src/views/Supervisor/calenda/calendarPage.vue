<template>
      <div class="mt-15">
        <div class="text-black border-b-2 border-gray-300 px-8 h-15 items-center" style="border-bottom: solid 1px;">
          <h1 class="font-bold text-3xl mb-3 hover:text-yellow-400 w-2/12">Calendar</h1>
        </div>
        
        <!-- Rout Calendar_workday -->
        <div class="container mx-auto px-6 py-4">
          <div class="flex justify-end space-x-4">
            <!-- Conditionally render buttons -->
            <a v-if="canCreateCalendar" 
               href="/workTime/create" 
               class="no-underline bg-black text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-400 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
              Add Work/Time
            </a>
  
            <a v-if="canCreateCalendar" 
               href="/holiday/create" 
               class="no-underline text-white font-bold px-5 py-2 rounded-lg shadow-md bg-blue-500 hover:bg-blue-400 transition-colors focus:outline-none focus:ring-2 focus:ring-green-300">
              Add Holiday
            </a>
          </div>
        </div>
  
        <!-- Calendar Display -->
        <div class="container mx-auto">
          <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4">
              <FullCalendar :events="calendarEvents" />
            </div>
          </div>
        </div>
  
        <!-- Workdays and Times -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-14">
          <h2 class="text-2xl font-bold mb-4">Workdays and Times</h2>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Day</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day Type</th>
                <th class="px-6 py-3 w-2/12 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="workday in calendarWorkDays" :key="workday.id" class="hover:bg-gray-100">
                <td class="py-4 px-6 border-b border-gray-200">{{ workday.work_day }}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{ workday.start_time }}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{ workday.end_time }}</td>
                <td class="py-4 px-6 border-b border-gray-200">{{ workday.day_type }}</td>
                <td class="py-4 px-6 border-b border-gray-200 text-right">
                  <a v-if="canEditCalendar" 
                     :href="`/admin/calendar_workday/${workday.id}/edit`" 
                     class="text-white font-bold py-1 px-3 rounded text-xs bg-black hover:bg-yellow-400 text-white">Edit</a>
                  <button v-if="canDeleteCalendar" 
                          @click="deleteWorkday(workday.id)" 
                          class="text-white font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <!-- Holidays -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-14">
          <h2 class="text-2xl font-bold mb-4">Holidays</h2>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holiday Name</th>
                <th class="px-6 w-2/12 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                <th class="px-6 w-2/12 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holiday Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 w-2/12 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-100">
                    <td class="py-4 px-6 border-b border-gray-200">New Year</td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">12.04.2024</td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">15.04.2024</td>
                    <td class="py-4 px-6 border-b border-gray-200">national</td>
                    <td class="py-4 px-6 border-b border-gray-200">enjoy your days guys</td>
                    <td class="py-4 px-6 border-b border-gray-200 d-flex justify-center gap-3">
                        <a href="#" class="font-bold py-1 px-3 rounded text-xs bg-yellow-400 no-underline hover:bg-black text-white">Edit</a>
                        <form action="#" method="POST" class="inline">
                            <button class="text-white font-bold py-1 px-3 rounded text-xs bg-red-400 hover:bg-red-600 border-none">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import FullCalendar from '@fullcalendar/vue3';
  import dayGridPlugin from '@fullcalendar/daygrid';

  
  export default {
    components: {
      FullCalendar,
    },
    data() {
      return {
        canCreateCalendar: true, // Computed in real scenarios with permission check logic
        canEditCalendar: true,
        canDeleteCalendar: true,
        calendarEvents: [
          {
            title: 'Call with Dave',
            start: '2024-08-01',
            end: '2024-08-01',
            className: 'bg-gradient-danger'
          }
        ],
        calendarWorkDays: [
          // Your workday data here
        ],
        calendarHolidays: [
          // Your holiday data here
        ]
      };
    },
    methods: {
      deleteWorkday(id) {
        // Handle delete workday
      },
      deleteHoliday(id) {
        // Handle delete holiday
      }
    },
    mounted() {
      // Initialize any other logic if needed
    }
  };
  </script>
  
  <style scoped>
  .fc-col-header-cell {
    background-color: #FFDA03;
  }
  </style>
  
