<template>
  <div>
    <h1>Team Members</h1>
    <h1>Member of Team {{ teamCount }}</h1>
    <table v-if="authStore.member" class="min-w-full table-auto border-collapse">
      <thead>
        <tr>
          <th class="border px-4 py-2">Staff ID</th>
          <th class="border px-4 py-2">Profile</th>
          <th class="border px-4 py-2">Name</th>
          <th class="border px-4 py-2">Gender</th>
          <th class="border px-4 py-2">Email</th>
          <th class="border px-4 py-2">Date of Birth</th>
          <th class="border px-4 py-2">Position</th>
          <th class="border px-4 py-2">Department</th>
          <th class="border px-4 py-2">Joined Date</th>
          <th class="border px-4 py-2">Confirm Date</th>
          <th class="border px-4 py-2">Supervisor</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(member, index) in authStore.member" :key="index">
          <td class="border px-4 py-2">{{ member.staff_id }}</td>
          <td class="border px-4 py-2">
            <img
              :src="
                member.profile && member.profile
                  ? `http://127.0.0.1:8000/images/${member.profile}`
                  : '/images/default-profile.jpg'
              "
              alt="Profile Picture"
              class="w-16 h-16 rounded-full"
            />
          </td>
          <td class="border px-4 py-2">{{ member.full_name }}</td>
          <td class="border px-4 py-2">{{ member.gender }}</td>
          <td class="border px-4 py-2">{{ member.email }}</td>
          <td class="border px-4 py-2">{{ member.dob }}</td>
          <td class="border px-4 py-2">{{ member.position.name }}</td>
          <td class="border px-4 py-2">{{ member.department.name }}</td>
          <td class="border px-4 py-2">{{ member.joined_date }}</td>
          <td class="border px-4 py-2">{{ member.entitled_date }}</td>
          <td class="border px-4 py-2">{{ member.manager.full_name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/get-member' // Make sure the path is correct
// import { onMounted } from 'vue'

export default {
  setup() {
    const authStore = useAuthStore()

    // Fetch member data when component is mounted
    // onMounted(() => {
    //   authStore.fetchMember() // Call the fetchMember method from the store
    // })

    return { authStore,teamCount: authStore.teamCount, }
  }
}
</script>
