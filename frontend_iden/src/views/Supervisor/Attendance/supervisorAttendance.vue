<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar />
      </div>
      <div class="container-page">
        <WebHeaderMenu />
        <main class="bg-gray sticky top-0">
          <div class="mt-16">
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <router-link to="/supervisor/attendance">
                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
              </router-link>
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"><b>My Attendance</b></h1>
            </div>
            <div class="mt-20">
              <div class="printpage d-flex justify-end mr-8 gap-3 mt-16 mb-3">
                <button @click="exportPDF" class="border-none bg-blue-600 text-white px-3 py-2 rounded-lg shadow-md hover:bg-yellow-500">
                  Export
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                  </svg>
                </button>
                <button @click="printSection" class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500">Print</button>
              </div>
              <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="flex justify-between px-4 py-3 sm:px-6">
                  <div>
                    <h3 class="text-lg font-medium leading-6 text-yellow-400">Attendance Records</h3>
                    <p class="mt-1 text-sm text-gray-500">Detailed attendance records for me.</p>
                  </div>
                  <div class="w-5/12 flex justify-between">
                    <input v-model="searchQuery" placeholder="Search employee by name..." class="w-4/6 py-2 px-2 bg-blue-100 mt-3 h-9 border rounded" />
                    <a href="/supervisor/myattendance" class="bg-gray-900 d-flex items-center justify-center mt-3 h-9 w-35 text-white font-semibold no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">My Attendance</a>
                  </div>
                </div>
                <div id="attendance_records" class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-black">
                      <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Employee</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Check In</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Check Out</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Hours Worked</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Remarks</th>
                      </tr>
                    </thead>
                    <tbody v-if="attendances.length" class="bg-white divide-y divide-gray-200">
                      <tr v-for="attendance in filteredAttendances" :key="attendance.id" class="hover:bg-gray-100 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 text-left text-sm font-medium text-black font-bold">{{ attendance.employee.full_name }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.date }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.status }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.clock_in }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.clock_out }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.hours_worked }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.remarks }}</td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-600">No attendance records found.</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
import html2pdf from 'html2pdf.js';
import axiosInstance from '@/plugins/axios';
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  name: "AttendanceRecords",
  data() {
    return {
      searchQuery: '', // Holds the search input
      attendances: [], // Array of attendance records
    };
  },
  mounted() {
    this.fetchAttendanceRecords(); // Fetch data on mount
  },
  computed: {
    filteredAttendances() {
      const query = this.searchQuery.trim().toLowerCase();
      if (!query) return this.attendances;
      return this.attendances.filter(attendance =>
        attendance.date.includes(query) ||
        attendance.employee.full_name.toLowerCase().includes(query)
      );
    },
  },
  methods: {
    async fetchAttendanceRecords() {
      try {
        const response = await axiosInstance.get('/attendance/history');
        this.attendances = response.data;
      } catch (error) {
        console.error('Error fetching attendance records:', error);
      }
    },
    printSection() {
      window.print();
    },
    exportPDF() {
      const element = document.getElementById("attendance_records");
      const options = {
        margin: 1,
        filename: 'attendance_record.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
      html2pdf().set(options).from(element).save();
    }
  },
};
</script>

<style scoped>
.supervisor {
  display: flex;
  height: 100vh;
  align-items: start;
  width: 100%;
  background-color: #E5E7EB;
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
  background-color: #E5E7EB;
  margin-bottom: 50px;
}
</style>
