<template>
  <SupervisorLayout>
    <div class="supervisor">
      <div class="sidebar">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page">
        <WebHeaderMenu/>
        <main class="bg-gray sticky top-0">
          <div class="mt-16">
    <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
      <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"><b>Team Attendance</b></h1>
    </div>
    <div class="mt-20">
      <div class="printpage d-flex justify-end mr-8 gap-3 mt-16 mb-3">
        <button @click="Export()" class="border-none bg-blue-600 text-white px-3 py-2 rounded-lg shadow-md hover:bg-yellow-500">Export
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
          </svg>
        </button>
        <button @click="printSection" class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500">Print</button>
      </div>
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-between px-4 py-3 sm:px-6">
          <div>
            <h3 class="text-lg font-medium leading-6 text-yellow-400">Attendance Records in Team</h3>
            <p class="mt-1 text-sm text-gray-500">Detailed attendance records for all employees who stay in my team.</p>
          </div>
          <!-- Search Bar -->
          <div class="w-5/12 flex justify-between">
              <input v-model="searchQuery" placeholder="Search employee by name..." class="w-4/6 py-2 px-2 bg-blue-100 mt-3 h-9 border rounded">
              <a  href="/supervisor/myattendance" class="bg-gray-900 d-flex items-center justify-center mt-3 h-9 w-35 text-white font-semibold no-underline rounded-lg shadow-md hover:bg-yellow-500 transition-colors">My Attendance</a>
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
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Loop through filtered attendances -->
              <tr 
                v-for="attendance in filteredAttendances" 
                :key="attendance.id" 
                class="hover:bg-gray-100 transition duration-150 ease-in-out"
              >
                <td class="px-6 py-4 text-left text-sm font-medium text-black font-bold">{{ attendance.employee.full_name }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.date }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.status }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.clock_in }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.clock_out }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.hours_worked }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ attendance.remarks }}</td>
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
export default {
  components: {SupervisorSidebar, WebHeaderMenu},
  name: "AttendanceRecords",
  data() {
    return {
      searchQuery: '', // Holds the search input
      attendances: [], // Initialize with an empty array of attendance records
    };
  },
  mounted() {
    // Fetch attendance records when the component is mounted
    this.fetchAttendanceRecords();
  },
  computed: {
  // Filter attendances based on the search query (either date or employee name)
  filteredAttendances() {
    const query = this.searchQuery.trim().toLowerCase();
    if (!query) {
      return this.attendances; // If no query, return all attendances
    }
    return this.attendances.filter(attendance => 
      // Check if the date matches the query or if the employee's name includes the query
      attendance.date.includes(query) ||
      attendance.employee.full_name.toLowerCase().includes(query)
    );
  },
},

  methods: {
    fetchAttendanceRecords() {
      // Dummy data for demo purposes
      this.attendances = [
        {
          id: 1,
          employee: { full_name: 'John Doe' },
          date: '2024-08-14',
          status: 'present',
          clock_in: '09:00 AM',
          clock_out: '05:00 PM',
          hours_worked: '8',
          remarks: 'On time',
        },
        {
          id: 2,
          employee: { full_name: 'Jane Smith' },
          date: '2024-10-14',
          status: 'present',
          clock_in: '09:30 AM',
          clock_out: '05:30 PM',
          hours_worked: '7.5',
          remarks: 'Late',
        },
        {
          id: 3,
          employee: { full_name: 'Sam Wilson' },
          date: '2024-10-14',
          status: 'absent',
          clock_in: null,
          clock_out: null,
          hours_worked: '0',
          remarks: 'Sick leave',
        },
        // Add more records as needed
      ];
    },
    printSection() {
      const printContents = document.getElementById("attendance_records").innerHTML;
      const originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      window.location.reload(); // Reload to reset original contents
    },
    Export() {
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