import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useNotificationStore = defineStore('notification', {
  state: () => ({
    notifications: 0
  }),
  actions: {
    // =====>Fetch pending notifications count<====
    async fetchNotifications() {
      try {
        const response = await axiosInstance.get('notification', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        
        this.notifications = response.data.notificationsCount
        console.log('Fetched notifications:', this.notifications)
      } catch (error) {
        console.error('Error fetching notifications:', error)
      }
    },

    // ===>Read notifications<====
    async clearNotifications() {
      try {
          const response = await axiosInstance.delete('notification/clear', {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem('access_token')}`,
              }
          });
          const { updatedNotificationCount,} = response.data;
          this.notifications = updatedNotificationCount;
      } catch (error) {
          console.error('Error clearing notifications and deleting leave counts:', error);
      }
  }
  
  }
})