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
      path: '/Supervisor/dashboard',
      name: 'dashboard',
      component: () => import('../views/Supervisor/SupervisorView.vue')
      
    },
    {
      path: '/',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/forgotPassword',
      name: 'forgotPassword',
      component: () => import('../views/Admin/Auth/forgotPassword.vue')
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

    //..............................supervisor routes -------------------------------- 
    {
      path: '/Supervisor/calendar',
      'name': 'calendar',
      component: () => import('../views/Supervisor/calenda/calendarPage.vue'),
    },
    {
      path: '/Supervisor/calendar/holiday/create',
      'name': 'holidayCreate',
      component: () => import('../views/Supervisor/calenda/holiday/createHoliday.vue'),
    },
    {
      path: '/Supervisor/calendar/workTime/create',
      'name': 'workTimeCreate',
      component: () => import('../views/Supervisor/calenda/work_time/addWorkTime.vue'),
    },
    {
      path: '/Supervisor/calendar/workTime/edit',
      'name': 'workTimeEdit',
      component: () => import('../views/Supervisor/calenda/work_time/editWorkTime.vue'),
    },
    {
      path: '/Supervisor/calendar/holiday/edit',
      'name': 'holidayEdit',
      component: () => import('../views/Supervisor/calenda/holiday/editHoliday.vue'),
    },
    {
      path: '/Supervisor/takeLeave',
      'name': 'takeLeave',
      component: () => import('../views/Supervisor/take_leaves/take_leave.vue'),
    },
    {
      path: '/Supervisor/takeLeave/view/leaveHistory',
      'name': 'viewLeaveHistory',
      component: () => import('../views/Supervisor/take_leaves/viewleaveHistory.vue'),
    },
    {
      path: '/Supervisor/takeLeave/All/leaveHistory',
      'name': 'AllLeaveHistory',
      component: () => import('../views/Supervisor/take_leaves/AllLeaveHistory.vue'),
    },
    {
      path: '/Supervisor/takeLeave/All/leaveHistory/rejectHistory',
      'name': 'AllRejectHistory',
      component: () => import('../views/Supervisor/take_leaves/AllRejectedLeaves.vue'),
    },
    {
      path: '/Supervisor/takeLeave/requestLeave',
      'name': 'requestLeave',
      component: () => import('../views/Supervisor/take_leaves/requestLeave.vue'),
    },
    {
      path: '/Supervisor/requestLeave/myLeaved',
      'name': 'myLeaved',
      component: () => import('../views/Supervisor/take_leaves/MyLeave/MyHistoryLeave.vue'),
    },
    {
      path: '/Supervisor/requestLeave/myLeaved/viewHistory',
      'name': 'viewHistory',
      component: () => import('../views/Supervisor/take_leaves/MyLeave/viewMyHistory.vue'),
    },
    {
      path: '/Supervisor/Employee',
      'name': 'Employee',
      component: () => import('../views/Supervisor/Employees/EmployeePage.vue'),
    },
    
    {
      path: '/Supervisor/Employee/Update',
      'name': 'EmployeeUpdate',
      component: () => import('../views/Supervisor/Employees/emploeeUpdate.vue'),
    },
    {
      path: '/Supervisor/Employee/create',
      'name': 'Employeecreate',
      component: () => import('../views/Supervisor/Employees/createEmployee.vue'),
    },
    {
      path: '/Supervisor/Employee/create',
      'name': 'Employeecreate',
      component: () => import('../views/Supervisor/Employees/createEmployee.vue'),
    },
    {
      path: '/Supervisor/Employee/Profile/More',
      'name': 'EmployeeProfile',
      component: () => import('../views/Supervisor/Employees/EmployeeProfile.vue'),
    }, 
    {
      path: '/Supervisor/Attendance',
      'name': 'Attendance',
      component: () => import('../views/Supervisor/Attendance/AttendancePage.vue'),
    },
    {
      path: '/Supervisor/MyAttendance',
      'name': 'SupervisorAttendance',
      component: () => import('../views/Supervisor/Attendance/supervisorAttendance.vue'),
    },

    //----------------supervisor settings routes ---------------------------------
    {
      path: '/Supervisor/Settings',
      'name': 'Settings',
      component: () => import('../views/Supervisor/settings/settingPage.vue'),
    },

      //-----------------supervisor Department routes---------------- 
    {
      path: '/Supervisor/Settings/Departments',
      'name': 'Departments',
      component: () => import('../views/Supervisor/settings/depaetments/departmentPage.vue'),
    },
    {
      path: '/Supervisor/Settings/Departments/Create',
      'name': 'DepartmentsCreate',
      component: () => import('../views/Supervisor/settings/depaetments/createDepartment.vue'),
    },
    {
      path: '/Supervisor/Settings/Departments/Update',
      'name': 'DepartmentsUpdate',
      component: () => import('../views/Supervisor/settings/depaetments/editDepartment.vue'),
    },
    {
      path: '/Supervisor/Settings/Departments/View',
      'name': 'DepartmentsView',
      component: () => import('../views/Supervisor/settings/depaetments/viewDepartment.vue'),
    },
        //-----------------supervisor Position routes---------------- 
    {
      path: '/Supervisor/Settings/Positions',
      'name': 'Positions',
      component: () => import('../views/Supervisor/settings/positions/positionPage.vue'),
    },
    {
      path: '/Supervisor/Settings/Positions/Create',
      'name': 'PositionsCreate',
      component: () => import('../views/Supervisor/settings/positions/createPosition.vue'),
    },
    {
      path: '/Supervisor/Settings/Positions/Update',
      'name': 'PositionsUpdate',
      component: () => import('../views/Supervisor/settings/positions/editPosition.vue'),
    },
    

    //-----------------supervisor Leave Type routes---------------- 
    {
      path: '/Supervisor/Settings/LeaveType',
      'name': 'LeaveType',
      component: () => import('../views/Supervisor/settings/leave_types/leaveType.vue'),
    },

    //-----------------------------------employees routes --------------------------------
    {
      path: '/employee/leave',
      'name': 'leave',
      component: () => import('../views/Employee/LeavPage.vue'),
    },
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
