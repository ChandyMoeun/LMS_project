<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu/>
        <main class="sticky top-0">
          <div class="mt-15">
    <!-- Header -->
    <div class="text-black border-b-2 border-gray-300 px-8 h-15 items-center" style="border-bottom: solid 1px gray">
      <h1 class="font-bold text-3xl mb-3 hover:text-yellow-400 w-2/12">Calendar</h1>
    </div>

    <!-- Buttons for creating Work/Time or Holidays -->
    <div class="container mx-auto px-6 py-4">
      <div class="flex justify-end space-x-4">
        <a v-if="canCreateCalendar" 
           href="/Supervisor/calendar/workTime/create" 
           class="no-underline bg-gray-900 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-500 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
          Add Work/Time
        </a>
        <a v-if="canCreateCalendar" 
           href="/Supervisor/calendar/holiday/create" 
           class="no-underline text-white font-bold px-5 py-2 rounded-lg shadow-md bg-blue-500 hover:bg-blue-400 transition-colors focus:outline-none focus:ring-2 focus:ring-green-300">
          Add Holiday
        </a>
      </div>
    </div>

    <!-- FullCalendar Display -->
    <div class="container mx-auto">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4">
          <div id="calendar" class="h-96"></div> <!-- Calendar will be rendered here -->
        </div>
      </div>
    </div>

    <!-- Workdays and Times Table -->
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
          <tr v-for="work in work_days" :key="work.id" class="hover:bg-gray-100">
            <td class="py-4 px-6 border-b border-gray-200">{{ work.work_day }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ work.start_time }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ work.end_time }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ work.day_type }}</td>
            <td class="py-4 px-6 border-b border-gray-200 d-flex justify-center gap-3">
              <a href="/Supervisor/calendar/workTime/edit" class="font-bold py-1 px-3 rounded flex items-center text-xs bg-gray-900 no-underline hover:bg-yellow-500 text-white">Edit</a>
              <form action="#" method="POST" class="inline">
                <button class="text-white font-bold py-2 px-3 rounded text-xs bg-red-400 hover:bg-red-600 border-none">Delete</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Holidays Table -->
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
            <td class="py-4 px-6 border-b border-gray-200">National</td>
            <td class="py-4 px-6 border-b border-gray-200">Enjoy your days guys</td>
            <td class="py-4 px-6 border-b border-gray-200 d-flex justify-center gap-3">
              <a href="/Supervisor/calendar/holiday/edit" class="font-bold py-1 px-3 rounded flex items-center text-xs bg-gray-900 no-underline hover:bg-yellow-500 text-white">Edit</a>
              <form action="#" method="POST" class="inline">
                <button class="text-white font-bold py-2 px-3 rounded text-xs bg-red-400 hover:bg-red-600 border-none">Delete</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div> 
        </main>
      </div>
    </div>
  </SupervisorLayout>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue';
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
import { onMounted } from "vue";
import { Calendar } from "@fullcalendar/core"; // Import FullCalendar core
import dayGridPlugin from "@fullcalendar/daygrid"; // Import DayGrid plugin

export default {
  components: {SupervisorSidebar, WebHeaderMenu},
  data() {
    return {
      canCreateCalendar: true,
      calendarEvents: [
        {
          title: 'Call with Dave',
          start: '2024-08-01',
          end: '2024-08-01',
          className: 'bg-gradient-danger',
        },
        // Add other events here...
      ],
      work_days: [],

    };
  },

  mounted() {
    this.fetchWorkDays();
  },

  methods: {
    async fetchWorkDays() {
      try {
        const response = await axiosInstance.get("/calendar_work");
        this.work_days = response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },

  setup() {
    onMounted(() => {
      const calendarEl = document.getElementById("calendar");

      const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
          start: 'title', // Title in the header
          center: '',
          end: 'today prev,next', // Navigation buttons
        },
        selectable: true,
        editable: true,
        events: [
          {
            title: 'Call with Dave',
            start: '2024-08-01',
            end: '2024-08-01',
            className: 'bg-gradient-danger'
          },
          // Add other events here...
        ],
        views: {
          month: {
            titleFormat: {
              month: "long",
              year: "numeric",
            },
          },
          agendaWeek: {
            titleFormat: {
              month: "long",
              year: "numeric",
              day: "numeric",
            },
          },
          agendaDay: {
            titleFormat: {
              month: "short",
              year: "numeric",
              day: "numeric",
            },
          },
        },
      });

      calendar.render();
    });
  },
};

</script>


<style>
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
/* Custom styles for the FullCalendar header */
.fc-col-header-cell {
  background-color: #FFDA03;
}

.fc .fc-daygrid-day-number, .fc .fc-col-header-cell-cushion {
    color: #000000;
    text-decoration: none;
}

</style>