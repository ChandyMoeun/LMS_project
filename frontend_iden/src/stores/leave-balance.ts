import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useLeaveBalanceStore = defineStore('leaveBalance', {
  state: () => ({
    leaveBalances: [] as Array<{
      id: number
      employee_id: number
      leave_type_id: number
      used: number
      available: number
    }>
  }),
  actions: {
    // ====>Fetch all leave balances<====
    async fetchLeaveBalances() {
      try {
        const response = await axiosInstance.get('leave_balances', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.leaveBalances = response.data.data
      } catch (error) {
        console.error('Error fetching leave balances:', error)
      }
    },
    // ===>Fetch leave balance for a specific employee<====
    async fetchLeaveBalanceByEmployee(employeeId: number) {
      try {
        const response = await axiosInstance.get(`leave-balances/${employeeId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.leaveBalances = [response.data] 
      } catch (error) {
        console.error('Error fetching leave balance:', error)
      }
    }
  }
})
