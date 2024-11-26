import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const  useLeaveTypeStore = defineStore('leaveType', {
  state: () => ({
    leaveTypes: [] as Array<{
      id: number;
      leave_name: string;
      employee_id: number;
      requires_attachment: boolean;
      auto_increase_entitlement: boolean;
      increase_rate: number;
    }>
  }),
  actions: {
    // Fetch all leave types
    async fetchLeaveTypes() {
      try {
        const response = await axiosInstance.get('/leave_types', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        this.leaveTypes = response.data.data;

        // Log the fetched leave types
        console.log('Fetched leave types:', this.leaveTypes);
      } catch (error) {
        console.error('Error fetching leave types:', error);
      }
    },

    // Fetch leave type by ID
    async fetchLeaveTypeById(id: number) {
      try {
        const response = await axiosInstance.get(`/leave_types/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        const leaveType = response.data.data;

        // Update the state if needed (e.g., add or replace in the array)
        const index = this.leaveTypes.findIndex((type) => type.id === id);
        if (index !== -1) {
          this.leaveTypes[index] = leaveType;
        } else {
          this.leaveTypes.push(leaveType);
        }

        // Log the fetched leave type
        console.log(`Fetched leave type with ID ${id}:`, leaveType);
      } catch (error) {
        console.error(`Error fetching leave type with ID ${id}:`, error);
      }
    }
  }
});
