import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useNotificationStore = defineStore('notification', {
  state: () => ({
    notifications: 0
  }),
  actions: {
    // Fetch pending notifications count
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

    // Clear notifications
    async clearNotifications() {
      try {
          const response = await axiosInstance.delete('notification/clear', {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem('access_token')}`,
              }
          });
          // Assuming the response contains the updated counts after deletion
          const { updatedNotificationCount,} = response.data;
          // Update the state with the new values after deletion
          this.notifications = updatedNotificationCount;
          console.log(response.data.message); // Success message from the backend
      } catch (error) {
          console.error('Error clearing notifications and deleting leave counts:', error);
      }
  }
  
  }
})