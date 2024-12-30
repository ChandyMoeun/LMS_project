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
        this.positions = response.data
      } catch (error) {
        console.error('Error fetching positions:', error);
      }
    }
  }
});
