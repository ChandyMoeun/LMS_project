import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref()
  const isAuthenticated = ref()
  const permissions = ref()
  const roles = ref()
  const member = ref()
  const teamCount = ref(0);
  

  return {
    user,
    roles,
    permissions,
    isAuthenticated,
    member,
    teamCount,
  
  }
})
