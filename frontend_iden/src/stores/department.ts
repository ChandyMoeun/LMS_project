import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useDepartmentStore = defineStore('department', {
  state: () => ({
    departments: [] as Array<{ id: number; name: string; manager_id: number }>
  }),
  actions: {
    async fetchDepartments() {
      try {
        const response = await axiosInstance.get('departments', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.departments = response.data.data

        // Log the data to the console
        console.log('Fetched departments:', this.departments)
      } catch (error) {
        console.error('Error fetching departments:', error)
      }
    },
    async fetchDepartmentId(departmentId: number) {
      try {
        const response = await axiosInstance.get(`departments/${departmentId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })

        // Assuming the response contains a single department object
        this.departments = [response.data] // Wrap in an array if you're treating it as an array

        // Log the data to the console
        console.log('Fetched department:', this.departments)
      } catch (error) {
        console.error('Error fetching department:', error)
      }
    }
  }
})
