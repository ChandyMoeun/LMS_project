<template>
 <SupervisorLayout>
    <div class="supervisor flex h-screen items-start w-full">
      <div class="sidebar w-[17%] h-auto">
        <SupervisorSidebar></SupervisorSidebar>
      </div>
      <div class="container-page w-[83%]">
        <WebHeaderMenu />
        <main class="p-[50px] pt-[50px] pb-0 h-auto w-full bg-[#EEEDED] mb-[50px]">
          <div class="mt-16 px-10">
            <div class="d-flex text-black" style="display: flex; flex-direction: column; border-bottom: solid 1px gray;">
              <h1 class="font-bold text-3xl px-8 hover:text-yellow-500 w-4/12"><b>Team Attendance</b></h1>
            </div>
            <div class="mt-20">
              <div class="printpage d-flex justify-end mr-8 gap-3 mt-16 mb-3">
                <button @click="Export()"
                  class="border-none bg-blue-600 text-white px-3 py-2 rounded-lg shadow-md hover:bg-yellow-500">Export
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-2" >
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                  </svg>
                </button>
                <button @click="printSection" class="border-none bg-gray-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-500">
                  Print
                </button>
              </div>
              <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="flex justify-between px-4 py-3 sm:px-6">
                  <div>
                    <h3 class="text-lg font-medium leading-6 text-yellow-400">
                      Attendance Records in Team
                    </h3>
                    <p class="mt-1 text-sm text-gray-500"> Detailed attendance records for all employees who stay in my team.  </p>
                  </div>
                  <!-- Search Bar -->
                  <div class="w-5/12 flex justify-between">
                    <input v-model="searchQuery" placeholder="Search employee by name..." class="w-4/6 py-2 px-2 bg-blue-100 mt-3 h-9 border rounded">
                    <a  href="/supervisor/myattendance" class="bg-yellow-500 d-flex items-center justify-center mt-3 h-9 w-35 text-white font-semibold no-underline rounded-lg shadow-md hover:bg-gray-900 transition-colors">My Attendance</a>
                  </div>
                </div>
                <div id="attendance_records" class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-black">
                      <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider" > Employee </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Date </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Status </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Check In </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Check Out </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Hours Worked </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" > Remarks </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <!-- Loop through filtered attendances -->
                      <tr v-for="record in attendanceStore.attendance"
                        :key="record.id"
                        class="hover:bg-gray-100 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 text-left text-sm font-medium text-black font-bold">{{ record.employee_name }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.date }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.status }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.clock_in }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.clock_out }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.hours_worked }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">{{ record.remarks }}</td>
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
import SupervisorSidebar from '@/Components/SupervisorSidebar.vue'
import WebHeaderMenu from '@/Components/WebHeaderMenu.vue'
import html2pdf from 'html2pdf.js'
import { ref, onMounted } from 'vue'
import { useAttendanceStore } from '@/stores/employee-attendance'
export default {
  components: { SupervisorSidebar, WebHeaderMenu },
  name: 'AttendanceRecords',
  setup() {
    const attendanceStore = useAttendanceStore()
    const loading = ref(true)
    const error = ref(null)

    const fetchAttendance = async () => {
      try {
        await attendanceStore.fetchAttendance()
        loading.value = false
      } catch (err) {
        error.value = 'Failed to load attendance data'
        loading.value = false
      }
    }

    onMounted(() => {
      fetchAttendance()
    })

    return {
      attendanceStore,
      loading,
      error
    }
  },
  data() {
    return {
      searchQuery: '', 
      attendances: [] 
    }
  },
  // ===>Fetch attendance records when the component is mounted<===
  mounted() {
    this.fetchAttendanceRecords()
  },
  computed: {
    // ====>Filter attendances based on the search query (either date or employee name)<====
    filteredAttendances() {
      const query = this.searchQuery.trim().toLowerCase()
      if (!query) {
        return this.attendances 
      }
      return this.attendances.filter(
        (attendance) =>
          attendance.date.includes(query) ||
          attendance.employee.full_name.toLowerCase().includes(query)
      )
    }
  },

  methods: {
    fetchAttendanceRecords() {
      this.attendances = [
       
      ]
    },
    printSection() {
      const printContents = document.getElementById('attendance_records').innerHTML
      const originalContents = document.body.innerHTML
      document.body.innerHTML = printContents
      window.print()
      document.body.innerHTML = originalContents
      window.location.reload()
    },
    Export() {
      const element = document.getElementById('attendance_records')
      const options = {
        margin: 1,
        filename: 'attendance_record.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      }
      html2pdf().set(options).from(element).save()
    }
  }
}
</script>