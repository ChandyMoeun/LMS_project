<template>
    <EmployeeLayout>
      <div class="employee">
        <div class="sidebar">
          <EmployeeSidebar></EmployeeSidebar>
        </div>
        <div class="container-page">
          <WebHeaderMenu/>
          <main class="bg-gray sticky top-0">
            <div class="mt-16">
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"><b>My Attendance</b></h1>
            </div>
      <div class="mt-20">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <div class="flex justify-between px-4 py-3 sm:px-6">
            <div>
              <h3 class="text-lg font-medium leading-6 text-yellow-400">Attendance Records</h3>
              <p class="mt-1 text-sm text-gray-500">Detailed all attendance records for my attendance.</p>
            </div>
            <!-- Search Bar -->
            <input 
              v-model="searchQuery" 
              placeholder="Search..." 
              class="w-2/6 py-2 px-2 bg-blue-100 mt-3 h-9 border rounded"
            >
          </div>
          <div class="overflow-x-auto">
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
    </EmployeeLayout>
  </template>
  
  <script>
  import EmployeeSidebar from '@/Components/EmployeeSidebar.vue';
  import WebHeaderMenu from '@/Components/WebHeaderMenu.vue';
  export default {
  created () {
  },
  components: {EmployeeSidebar, WebHeaderMenu},
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
      filteredAttendances() {
    const query = this.searchQuery.trim().toLowerCase();
    if (!query) {
      return this.attendances; // If no query, return all attendances
    }
    return this.attendances.filter(attendance => 
      // Check if the date matches the query or if the employee's name includes the query
      attendance.date.includes(query) ||
      attendance.remarks.toLowerCase().includes(query)
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
            date: '2024-07-14',
            status: 'present',
            clock_in: '09:00 AM',
            clock_out: '05:00 PM',
            hours_worked: '8',
            remarks: 'On time',
          },
          {
            id: 2,
            employee: { full_name: 'John Doe' },
            date: '2024-10-14',
            status: 'present',
            clock_in: '09:30 AM',
            clock_out: '05:30 PM',
            hours_worked: '7.5',
            remarks: 'Late',
          },
          {
            id: 3,
            employee: { full_name: 'John Doe' },
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