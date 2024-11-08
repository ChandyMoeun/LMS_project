import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const useDepartmentStore = defineStore('department', {
  state: () => ({
    departments: [] as Array<{ id: number, name: string, manager_id: number }>
  }),
  actions: {
    async fetchDepartments() {
      try {
        const response = await axiosInstance.get('departments', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        this.departments = response.data;

        // Log the data to the console
        console.log('Fetched departments:', this.departments);
      } catch (error) {
        console.error('Error fetching departments:', error);
      }
    }
  }
});
