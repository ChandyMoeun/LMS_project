import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthStore = defineStore('auth', () => {

  const member = ref(null);
  const teamCount = ref(0);
  return {
    member,
    teamCount,
  };
});
