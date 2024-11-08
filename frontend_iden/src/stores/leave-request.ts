import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const useLeaveRequestStore = defineStore('leaveRequest', {
  state: () => ({
    leaveRequests: [] as Array<{ id: number, employee_id: number, LeaveType_id: number, half_day_type: string, start_time: string, end_time: string, attachment: string, total_request_days: number, from_date: string, to_date: string, status: string, approve_by: number, reject_by: number, pending_hr_approval: boolean, reason: string, duration_leave: number }>
  }),
  actions: {
    async fetchLeaveRequests() {
      try {
        const response = await axiosInstance.get('/leave_requests', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        this.leaveRequests = response.data;
        
        // Log the data to the console
        // console.log('Fetched leave requests:', this.leaveRequests);
      } catch (error) {
        console.error('Error fetching leave requests:', error);
      }
    }
  }
});
