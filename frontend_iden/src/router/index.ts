import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // ----- authentication -----
    {
      path: '/',
      name: 'Welcome',
      component: () => import('../views/Supervisor/SupervisorView.vue')
      
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    // ----- user -----
    // {
    //   path: '/employee_dashboard',
    //   name: 'employee_dashboard',
    //   component: () => import('../views/Employee/EmployeeView.vue'),
    //   meta: {
    //     requiresAuth: true,
    //     role: 'employee'
    //   }
    // },
    // {
    //   path: '/approver_dashboard',
    //   name: 'approver_dashboard',
    //   component: () => import('../views/Supervisor/SupervisorView.vue'),
    //   meta: {
    //     requiresAuth: true,
    //     role: 'approver'
    //   }
    // },
    {
      path: '/calendar',
      'name': 'calendar',
      component: () => import('../views/Supervisor/calenda/calendarPage.vue'),
    },
    {
      path: '/employee/leave',
      'name': 'leave',
      component: () => import('../views/Employee/LeavPage.vue'),
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/', '/login']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    // Attempt to fetch the current user's details
    const { data } = await axiosInstance.get('/me')
    // Update the auth store with the fetched data
    store.isAuthenticated = true
    store.user = data.data
    store.permissions = data.data.permissions.map((item:any) => item.name)
    store.roles = data.data.roles.map((item:any) => item.name)

    // Define ACL rules based on the user's permissions
    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission:any) => {
          setRule(permission, () => true)
        })
      })

    simpleAcl.rules = rules()

    // Redirect authenticated users to their dashboard
    if (publicPages.includes(to.path) && store.isAuthenticated) {
      if (store.roles.includes('employee')) {
        return next('/employee_dashboard')
      }
      if (store.roles.includes('approver')) {
        console.log(store.roles);
        return next('/approver_dashboard')
      }
    }
  } catch (error) {
    // If an error occurs (e.g., unauthenticated), reset the auth store
    store.isAuthenticated = false
    store.user = null
    store.permissions = []
    store.roles = []
  }

  // Redirect to login if the page requires authentication and the user isn't authenticated
  if (authRequired && !store.isAuthenticated) {
    return next('/login')
  }

  // Check if the user's role matches the route's required role
  if (to.meta.role && !store.roles.includes(to.meta.role)) {
    return next('/login')
  }

  next()
})

export default { router, simpleAcl }
