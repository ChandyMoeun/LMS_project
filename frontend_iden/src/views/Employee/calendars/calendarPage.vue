<template>
  <EmployeeLayout>
    <div class="employee">
      <div class="sidebar">
        <EmployeeSidebar></EmployeeSidebar>
      </div>
      <div class="container-page">
        <EmployeeNavbar />
        <main class="sticky top-0">
          <div class="mt-15">
            <!-- Header -->
            <div class="text-black" style="border-bottom: solid 1px gray">
              <h1 class="font-bold text-3xl mb-3 hover:text-yellow-500 w-2/12">Calendar</h1>
            </div>
            <!-- FullCalendar Display -->
            <div class="container mt-16 mx-auto">
              <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-4">
                  <div id="calendar" class="h-96"></div>
                  <!-- Calendar will be rendered here -->
                </div>
              </div>
            </div>

            <!-- Workdays and Times Table -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-14">
              <h2 class="text-2xl font-bold mb-4">Workdays and Times</h2>
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Work Day
                    </th>
                    <th
                      class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Start Time
                    </th>
                    <th
                      class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      End Time
                    </th>
                    <th
                      class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Day Type
                    </th>
                  </tr>
                </thead>
                <tbody
                  v-for="work_day in calendarWorkdays"
                  :key="work_day.id"
                  class="bg-white divide-y divide-gray-200"
                >
                  <tr class="hover:bg-gray-100">
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ work_day.work_day }}
                    </td>
                    <td class="py-4 px-6 border-b border-gray-200">{{ work_day.start_time }}</td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ work_day.end_time }}
                    </td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ work_day.day_type }}
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
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Holiday Name
                    </th>
                    <th
                      class="px-6 w-2/12 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      From
                    </th>
                    <th
                      class="px-6 w-2/12 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      To
                    </th>
                    <th
                      class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Holiday Type
                    </th>
                    <th
                      class="px-6 text-center py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Description
                    </th>
                  </tr>
                </thead>
                <tbody
                  v-for="holiday in calendarHolidays"
                  :key="holiday.id"
                  class="bg-white divide-y divide-gray-200"
                >
                  <tr class="hover:bg-gray-100">
                    <td class="py-4 px-6 border-b border-gray-200">{{ holiday.holiday_name }}</td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ holiday.from_date }}
                    </td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ holiday.to_date }}
                    </td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ holiday.holiday }}
                    </td>
                    <td class="py-4 px-6 border-b text-center border-gray-200">
                      {{ holiday.description }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </EmployeeLayout>
</template>
  
<script>
import axiosInstance from '@/plugins/axios'
import EmployeeSidebar from '@/Components/EmployeeSidebar.vue'
import EmployeeNavbar from '@/Components/EmployeeNavbar.vue'
import { onMounted, ref } from 'vue'
import { Calendar } from '@fullcalendar/core' // Import FullCalendar core
import dayGridPlugin from '@fullcalendar/daygrid' // Import DayGrid plugin

export default {
  components: { EmployeeSidebar, EmployeeNavbar },
  setup() {
    const calendarHolidays = ref([]) // Reactive array for all calendar events
    const calendarWorkdays = ref([]) // Reactive array for

    // Fetch work days from the API
    const fetchWorkDays = async () => {
      try {
        const response = await axiosInstance.get('/calendar_work')
        // Push work day events into the calendarHolidays array
        calendarWorkdays.value = response.data
        console.log('Work calendar:', calendarWorkdays.value)
      } catch (error) {
        console.error('Error fetching work days:', error)
      }
    }

    // Fetch holidays from the API
    const fetchHoliday = async () => {
      try {
        const response = await axiosInstance.get('/calendar_holiday')
        // Push holiday events into the calendarHolidays array
        calendarHolidays.value = response.data
      } catch (error) {
        console.error('Error fetching holidays:', error)
      }
    }

    // Initialize FullCalendar on mount
    onMounted(async () => {
      await Promise.all([fetchWorkDays(), fetchHoliday()]) // Fetch data before rendering the calendar

      const calendarEl = document.getElementById('calendar')

      const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
          start: 'title', // Title in the header
          center: '',
          end: 'today prev,next' // Navigation buttons
        },
        selectable: true,
        editable: true,
        events: calendarHolidays.value, // Use the combined calendarHolidays array
        views: {
          month: {
            titleFormat: {
              month: 'long',
              year: 'numeric'
            }
          },
          agendaWeek: {
            titleFormat: {
              month: 'long',
              year: 'numeric',
              day: 'numeric'
            }
          },
          agendaDay: {
            titleFormat: {
              month: 'short',
              year: 'numeric',
              day: 'numeric'
            }
          }
        }
      })

      calendar.render()
    })

    return {
      calendarHolidays,
      calendarWorkdays
    }
  }
}
</script>

  
  
  <style>
.employee {
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #e5e7eb;
}
.sidebar {
  width: 17%;
  height: auto;
  background-color: #141c2e;
  color: white;
}
.container-page {
  width: 83%;
}
main {
  padding: 50px 50px 0px 50px;
  height: auto;
  width: 100%;
  background-color: #e5e7eb;
  margin-bottom: 50px;
}
/* Custom styles for the FullCalendar header */
.fc-col-header-cell {
  background-color: #ffda03;
  
}

.fc .fc-daygrid-day-number,
.fc .fc-col-header-cell-cushion {
  color: #000000;
  text-decoration: none;
}
</style>