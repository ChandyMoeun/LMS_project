// import { defineStore } from 'pinia';
// import { ref } from 'vue';

// export const useAuthStore = defineStore('auth', () => {

//   const member = ref(null);
//   const teamCount = ref(0);
//   return {
//     member,
//     teamCount,
//   };
// });

// import { defineStore } from 'pinia';
// import axiosInstance from '@/plugins/axios';

// export const useTeamStore = defineStore('team', {
//   state: () => ({
//     teamMembers: [] as Array<{
//       id: number;
//       full_name: string;
//       email: string;
//       position: { id: number; name: string } | null;
//       department: { id: number; name: string } | null;
//       manager: { id: number; full_name: string } | null;
//     }>,
//     teamMember: null as {
//       id: number;
//       full_name: string;
//       email: string;
//       position: { id: number; name: string } | null;
//       department: { id: number; name: string } | null;
//       manager: { id: number; full_name: string } | null;
//     } | null
//   }),
//   actions: {
//     // Fetch all team members
//     async fetchTeamMembers() {
//       try {
//         const response = await axiosInstance.get('team', {
//           headers: {
//             Authorization: `Bearer ${localStorage.getItem('access_token')}`
//           }
//         });

//         // Assuming `data.teams` contains an array of team members
//         this.teamMembers = response.data.teams;

//         // Log the data for debugging
//         console.log('Fetched team members:', this.teamMembers);
//       } catch (error) {
//         console.error('Error fetching team members:', error);
//       }
//     },

//     // Fetch a specific team member by ID
//     async fetchTeamMemberById(memberId: number) {
//       try {
//         const response = await axiosInstance.get(`team/${memberId}`, {
//           headers: {
//             Authorization: `Bearer ${localStorage.getItem('access_token')}`
//           }
//         });

//         // Assuming `data.team_member` contains the team member's data
//         this.teamMember = response.data.team_member;

//         // Log the data for debugging
//         console.log('Fetched team member:', this.teamMember);
//       } catch (error) {
//         console.error('Error fetching team member:', error);
//       }
//     }
//   }
// });

import { defineStore } from 'pinia'
import axiosInstance from '@/plugins/axios'

export const useTeamStore = defineStore('team', {
  state: () => ({
    teamMembers: [], // Store team members
    teamCount: 0 // Store the count of team members
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
    // Fetch a specific team member by ID
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
