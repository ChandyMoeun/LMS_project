import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios'// Import your configured Axios instance
import { ref } from 'vue';

export const userAuthStore = defineStore('auth', () => {
  const user = ref(null);
  const isAuthenticated = ref(false);

  const fetchAuthUser = async () => {
    try {
      const response = await axiosInstance.get('/me');
      user.value = response.data.user;
      isAuthenticated.value = true;
      console.log(user.value);
    } catch (error) {
      console.error('Error fetching authenticated user:', error);
      isAuthenticated.value = false;
    }
  };

  return {
    user,
    isAuthenticated,
    fetchAuthUser,
  };
});
