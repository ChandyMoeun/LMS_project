// import { defineStore } from 'pinia'
// import { ref } from 'vue'

// export const useAuthStore = defineStore('auth', () => {
  
//   const team = ref()
//   const teamCount = ref(0);
  

//   return {
    
//     team,
//     teamCount,
  
//   }
// })

import { defineStore } from 'pinia'
import { ref } from 'vue'
import axiosInstance from '@/plugins/axios' // Ensure the correct path to your axios instance

export const useAuthStore = defineStore('auth', () => {
  const team = ref([]) // Default team as an empty array
  const teamCount = ref(0) // Default team count as 0

  // Fetch team data from the API
  const fetchTeamData = async () => {
    try {
      const { data } = await axiosInstance.get('/team') // Replace with your API endpoint
      team.value = data.teams || [] // Assign the team data
      teamCount.value = data.team_count || 0 // Assign the team count
      console.log('Fetched team data:', team.value, teamCount.value) // Log fetched data for debugging
    } catch (error) {
      console.error('Error fetching team data:', error)
      team.value = [] // Reset team on error
      teamCount.value = 0 // Reset teamCount on error
    }
  }

  return {
    team,
    teamCount,
    fetchTeamData // Expose the fetch method for usage in components
  }
})

