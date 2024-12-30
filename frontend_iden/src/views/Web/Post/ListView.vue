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
// ===>Fetch all team members on component mount<===
onMounted(() => {
  teamStore.fetchTeamMembers();
});
const viewTeamMember = (id) => {
  teamStore.fetchTeamMemberById(id);
};

const { teamMembers } = teamStore;
</script>
