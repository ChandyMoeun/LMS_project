import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';

export const usePositionStore = defineStore('position', {
  state: () => ({
    positions: [] as Array<{ id: number, name: string, department_id: string }>
  }),
  actions: {
    async fetchPositions() {
      try {
        const response = await axiosInstance.get('/position/list', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        
        // Assuming the response contains position data with department details
        this.positions = response.data
        // console.log(response.data);

        // Log the fetched positions to the console
        console.log('Fetched positions:', this.positions);
      } catch (error) {
        console.error('Error fetching positions:', error);
      }
    }
  }
});
