import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useAttendanceStore = defineStore('attendance', {
  state: () => ({
    attendance: [] as Array<{ id: number; date: string; status: string; remarks?: string }>,
  }),

  actions: {
    // Fetch attendance records
    async fetchAttendance() {
      try {
        const response = await axiosInstance.get('/attendance/history', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Use the token for authentication
          },
        })

        // Store the attendance records
        this.attendance = response.data.attendance_records // Adjust the response based on your API's structure
        
        // Log the data to the console for debugging
        console.log('Fetched attendance records:', this.attendance)
      } catch (error) {
        console.error('Error fetching attendance:', error)
      }
    },

    // Fetch a specific attendance record by ID
    async fetchAttendanceById(attendanceId: number) {
      try {
        const response = await axiosInstance.get(`/attendance/${attendanceId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`,
          },
        })

        // Assuming the response contains a single attendance object
        this.attendance = [response.data] // Wrap the result in an array if needed
        
        // Log the data to the console
        console.log('Fetched attendance:', this.attendance)
      } catch (error) {
        console.error('Error fetching attendance by ID:', error)
      }
    }
  }
})
