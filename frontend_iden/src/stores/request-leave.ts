import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'
import { ref } from 'vue'

interface LeaveRequest {
  id: number
  employee_id: number
  leaveType_id: number
  half_day_type: string
  start_time: string
  end_time: string
  attachment?: string
  total_request_days: number
  from_date: string
  to_date: string
  status: string
  approve_by?: number | null
  reject_by?: number | null
  pending_hr_approval: boolean
  reason: string
  duration_leave: number
}

interface LeaveRequestData {
  employee_id: number
  leaveType_id: number
  half_day_type: string
  start_time: string
  end_time: string
  attachment?: string
  total_request_days: number
  from_date: string
  to_date: string
  status: string
  pending_hr_approval: boolean
  reason: string
}

export const useLeaveRequestStore = defineStore('leaveRequest', {
  state: () => ({
    leaveRequests: [] as LeaveRequest[],
    requestStatus: null as 'success' | 'error' | null,
    leaveRequestCountThisWeek:0
  }),
  actions: {
    // Submit a new leave request
    async submitLeaveRequest(leaveRequestData: LeaveRequestData) {
      this.requestStatus = null // Reset status at the start

      try {
        const response = await axiosInstance.post('leave_requests', leaveRequestData, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`,
            'Content-Type': "multipart/form-data"
          }
        })

        // Add the new leave request to the state
        this.leaveRequests.push(response.data)

        // Set the request status to success
        this.requestStatus = 'success'
      } catch (error) {
        console.error('Error submitting leave request:', error)

        // Set the request status to error
        this.requestStatus = 'error'
      }
    },

    // Fetch leave requests by ID
    async fetchLeaveRequestsById(id: number) {
      try {
        const response = await axiosInstance.get(`/leave_requests/team/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })

        // Update state with fetched leave requests
        this.leaveRequests = response.data.data
        // console.log('Fetched leave requests by ID:', this.leaveRequests)
      } catch (error) {
        console.error('Error fetching leave requests by ID:', error)
      }
    },

    // Fetch leave requests for the team
    async fetchTeamLeaveRequests() {
      try {
        const response = await axiosInstance.get('/leave_requests/team', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        // Update state with fetched team leave requests
        this.leaveRequests = response.data.data
        this.leaveRequestCountThisWeek = response.data.leave_request_count_this_week;
      } catch (error) {
        console.error('Error fetching team leave requests:', error)
      }
    },

    // Approve a leave request
    async approveLeaveRequest(id: number) {
      try {
        const response = await axiosInstance.post(
          `/leave_requests/${id}/approve_request`,
          {},
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('access_token')}`
            }
          }
        )

        // Update the leave request status in the state
        const approvedRequest = this.leaveRequests.find((req) => req.id === id)
        if (approvedRequest) {
          approvedRequest.status = 'approved' // Update status
        }

        // alert(response.data.message)
      } catch (error) {
        console.error('Error approving leave request:', error)
        alert('Error approving leave')
      }
    },

    // Reject a leave request
    async rejectLeaveRequest(id: number) {
      try {
        const response = await axiosInstance.post(
          `/leave_requests/${id}/reject_request`,
          {},
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('access_token')}`,
            },
          }
        );
        
        // Update the leave request status in the state
        const rejectedRequest = this.leaveRequests.find((req) => req.id === id);
        if (rejectedRequest) {
          rejectedRequest.status = 'rejected'; // Update status
        }

        // alert(response.data.message);
      } catch (error) {
        console.error('Error rejecting leave request:', error);
        alert('Error rejecting leave');
      }
    },    
  }
})
