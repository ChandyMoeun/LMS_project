
import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useTeamStore = defineStore('team', {
  state: () => ({
    teamMembers: [], 
    teamCount: 0 
  }),
  actions: {
    async fetchTeamMembers() {
      try {
        const response = await axiosInstance.get('/team', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.teamMembers = response.data.teams
        this.teamCount = response.data.team_count
        console.log('team members', this.teamMembers)
        console.log('team count', this.teamCount)
      } catch (error) {
        console.error('Error fetching team members:', error)
      }
    },
    // ===>Fetch a specific team member by ID<===
    async fetchTeamMemberById(id: number) {
      try {
        const response = await axiosInstance.get(`/team/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        })
        this.teamMembers= response.data.team_member;
        console.log('Fetched team member by ID:', this.teamMembers)
        
      } catch (error) {
        console.error('Error fetching team member by ID:', error)
      }
    }
  }
})
