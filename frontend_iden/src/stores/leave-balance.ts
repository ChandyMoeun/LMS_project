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
    // Fetch all leave balances
    async fetchLeaveBalances() {
      try {
        const response = await axiosInstance.get('leave_balances', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })

        // Set the fetched leave balances to the state
        this.leaveBalances = response.data.data

        // Log the data to the console
        console.log('Fetched leave balances:', this.leaveBalances)
      } catch (error) {
        console.error('Error fetching leave balances:', error)
      }
    },

    // Fetch leave balance for a specific employee
    async fetchLeaveBalanceByEmployee(employeeId: number) {
      try {
        const response = await axiosInstance.get(`leave-balances/${employeeId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })

        // Assuming the response contains a single leave balance object
        this.leaveBalances = [response.data] // Wrap in an array if you're treating it as an array

        // Log the data to the console
        console.log('Fetched leave balance for employee:', this.leaveBalances)
      } catch (error) {
        console.error('Error fetching leave balance:', error)
      }
    }
  }
})
