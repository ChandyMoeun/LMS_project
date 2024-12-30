import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useAttendanceStore = defineStore('attendance', {
  state: () => ({
    attendance: [] as Array<{
      id: number;
      employee_id: number;
      date: string;
      status: string;
      clock_in: string | null;
      clock_out: string | null;
      hours_worked: string | null;
      remarks: string | null;
    }>
  }),

  actions: {
    async fetchAttendance() {
      try {
        const response = await axiosInstance.get('/attendance/history', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`,
          },
        })
        this.attendance = response.data.attendance_records
      } catch (error) {
        console.error('Error fetching attendance:', error)
      }
    }
  }
})
