<template>
  <div>
    <h1>Team Members</h1>
    <ul>
      <li
        v-for="member in teamStore.teamMembers"
        :key="member.id"
        @click="viewTeamMember(member.id)"
      >
        {{ member.full_name }} - {{ member.position?.name }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useTeamStore } from '@/stores/get-member';

const teamStore = useTeamStore();

// Fetch all team members on component mount
onMounted(() => {
  teamStore.fetchTeamMembers();
});

// Trigger fetching details of a specific team member
const viewTeamMember = (id) => {
  teamStore.fetchTeamMemberById(id);
};

// Destructure the state from the store
// eslint-disable-next-line @typescript-eslint/no-unused-vars
const { teamMembers } = teamStore;
</script>
