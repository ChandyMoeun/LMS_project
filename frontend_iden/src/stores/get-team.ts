import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  
  const team = ref()
  const teamCount = ref(0);
  

  return {
    
    team,
    teamCount,
  
  }
})
