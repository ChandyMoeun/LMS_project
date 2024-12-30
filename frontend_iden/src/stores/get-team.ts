import { defineStore } from 'pinia'
import { ref } from 'vue'
import axiosInstance from '@/plugins/axios' 

export const useAuthStore = defineStore('auth', () => {
  const team = ref([]) 
  const teamCount = ref(0) 
  // ===>Fetch team data from the API<=====
  const fetchTeamData = async () => {
    try {
      const { data } = await axiosInstance.get('/team') 
      team.value = data.teams || [] 
      teamCount.value = data.team_count || 0 
      console.log('Fetched team data:', team.value, teamCount.value) 
    } catch (error) {
      console.error('Error fetching team data:', error)
      team.value = [] 
      teamCount.value = 0 
    }
  }
  return {
    team,
    teamCount,
    fetchTeamData 
  }
})

