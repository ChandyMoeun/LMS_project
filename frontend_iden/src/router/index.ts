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
      path: '/supervisor/dashboard',
      name: 'dashboard',
      component: () => import('../views/Supervisor/SupervisorView.vue'),
      meta: {
        requiresAuth: true,
        role: 'supervisor'
      }
      
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
    {
      path: '/forgotPassword',
      name: 'forgotPassword',
      component: () => import('../views/Admin/Auth/forgotPassword.vue')
    },
    {
      path: '/my/profile',
      name: 'profile',
      component: () => import('../views/Supervisor/profilePage.vue')
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
      path: '/supervisor/calendars',
      'name': 'calendars',
      component: () => import('../views/Supervisor/calenda/calendarPage.vue'),
      meta: {
        requiresAuth: true,
        role: 'supervisor'
      }
    },
    {
      path: '/supervisor/takeleave',
      'name': 'takeLeave',
      component: () => import('../views/Supervisor/take_leaves/take_leave.vue'),
    },
    {
      path: '/supervisor/takeleave/view/leavedetail',
      'name': 'viewLeaveDetail',
      component: () => import('../views/Supervisor/take_leaves/viewleaveDetail.vue'),
    },
    {
      path: '/supervisor/takeleave/all/leavehistory',
      'name': 'AllLeaveHistory',
      component: () => import('../views/Supervisor/take_leaves/AllLeaveHistory.vue'),
    },
    {
      path: '/supervisor/takeleave/all/leavehistory/rejecthistory',
      'name': 'AllRejectHistory',
      component: () => import('../views/Supervisor/take_leaves/AllRejectedLeaves.vue'),
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
      path: '/supervisor/employee',
      'name': 'Employee',
      component: () => import('../views/Supervisor/Employees/EmployeePage.vue'),
    },
    {
      path: '/supervisor/employee/create',
      'name': 'Employeecreate',
      component: () => import('../views/Supervisor/Employees/createEmployee.vue'),
    },
    {
      path: '/supervisor/employee/profile/more',
      'name': 'EmployeeProfile',
      component: () => import('../views/Supervisor/Employees/EmployeeProfile.vue'),
    }, 
    {
      path: '/supervisor/attendance',
      'name': 'Attendance',
      component: () => import('../views/Supervisor/Attendance/AttendancePage.vue'),
    },
    {
      path: '/supervisor/myattendance',
      'name': 'SupervisorAttendance',
      component: () => import('../views/Supervisor/Attendance/supervisorAttendance.vue'),
    },

    //----------------supervisor settings routes ---------------------------------
    {
      path: '/supervisor/settings',
      'name': 'Settings',
      component: () => import('../views/Supervisor/settings/settingPage.vue'),
    },

      //-----------------supervisor Department routes---------------- 
    {
      path: '/supervisor/settings/departments',
      'name': 'Departments',
      component: () => import('../views/Supervisor/settings/depaetments/departmentPage.vue'),
    },
    {
      path: '/supervisor/settings/departments/view',
      'name': 'DepartmentsView',
      component: () => import('../views/Supervisor/settings/depaetments/viewDepartment.vue'),
    },
    {
      path: '/supervisor/settings/leavebalance',
      'name': 'leavebalance',
      component: () => import('../views/Supervisor/settings/leavebalance/leaveBalance.vue'),
    },
        //-----------------supervisor Position routes---------------- 
    {
      path: '/supervisor/settings/positions',
      'name': 'Positions',
      component: () => import('../views/Supervisor/settings/positions/positionPage.vue'),
    },
    

    //-----------------supervisor Leave Type routes---------------- 
    {
      path: '/supervisor/settings/leavetype',
      'name': 'LeaveType',
      component: () => import('../views/Supervisor/settings/leave_types/leaveType.vue'),
    },

    //-----------------supervisor Permissions routes---------------- 
    {
      path: '/supervisor/settings/permissions',
      'name': 'Permissions',
      component: () => import('../views/Supervisor/settings/Permissions/permissionsPage.vue'),
    },

    //-----------------supervisor Role routes---------------- 
    {
      path: '/supervisor/settings/role',
      'name': 'Role',
      component: () => import('../views/Supervisor/settings/Roles/rolePage.vue'),
    },

    //-----------------supervisor Reset Password routes---------------- 
    {
      path: '/supervisor/settings/resetpassword',
      'name': 'ResetPasswordForm',
      component: () => import('../views/Supervisor/settings/ResetPasswords/createResetPassword.vue'),
    },

    //-----------------------------------employees routes --------------------------------
    {
      path: '/employee/dashboard',
      'name': 'dashbaord',
      component: () => import('../views/Employee/EmDashboard.vue'),
      meta: {
        requiresAuth: true,
        role: 'employee',
      }
    },
              //----------------employees leave routes --------------------------------
    {
      path: '/employee/myleave',
      'name': 'leave',
      component: () => import('../views/Employee/myLeave/myLeavePage.vue'),
    },
    {
      path: '/employee/myleave/view/detail',
      'name': 'leaveDetail',
      component: () => import('../views/Employee/myLeave/myLeaveDetail.vue'),
    },
    {
      path: '/employee/myleave/historyleave',
      'name': 'historyleave',
      component: () => import('../views/Employee/myLeave/myLeaveHistory.vue'),
    },
    {
      path: '/employee/myleave/historyleave/detail',
      'name': 'leavehistorydetail',
      component: () => import('../views/Employee/myLeave/myHistoryDetail.vue'),
    },
    {
      path: '/employee/myleave/rejectedleave',
      'name': 'rejectedleave',
      component: () => import('../views/Employee/myLeave/rejectLeavePage.vue'),
    },
              //----------------employees calendar routes --------------------------------
    {
      path: '/employee/calendar',
      'name': 'calendar',
      component: () => import('../views/Employee/calendars/calendarPage.vue'),
    },
              //----------------employees attendance routes --------------------------------
    {
      path: '/employee/attendance',
      'name': 'attendance',
      component: () => import('../views/Employee/attendance/attendancePage.vue'),
    },
              //----------------employees team routes --------------------------------
    {
      path: '/employee/team',
      'name': 'team',
      component: () => import('../views/Employee/team/teamPage.vue'),
    },
    {
      path: '/employee/team/detail/:id',
      'name': 'TeamDetail',
      component: () => import('../views/Employee/team/teamDetailPage.vue'),
    },
              //----------------employees setting routes --------------------------------
    {
      path: '/employee/settings',
      'name': 'setting',
      component: () => import('../views/Employee/settings/settingPage.vue'),
    },
    {
      path: '/employee/settings/balances',
      'name': 'MyBalance',
      component: () => import('../views/Employee/settings/balances/balancePage.vue'),
    },
    {
      path: '/employee/settings/resetpassword',
      'name': 'resetpassword',
      component: () => import('../views/Employee/settings/resetPW/resetPw.vue'),
    },
    {
      path: '/employee/settings/profile',
      'name': 'profile',
      component: () => import('../views/Employee/settings/myprofile/myProfile.vue'),
    },

    // test ===
    {
      path: '/test',
      'name': 'test',
      component: () => import('../views/Web/Post/ListView.vue'),
    },
    {
      path: '/post',
      'name': 'post',
      component: () => import('../views/Web/Post/leaveRequest.vue'),
    },
  ]
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/','/login']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    // Attempt to fetch the current user's details
    const { data } = await axiosInstance.get('/me')
    store.member = data.team_members,
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
        return next('/employee/dashboard')
      }
      if (store.roles.includes('supervisor')) {
        console.log(store.roles);
        return next('/Supervisor/dashboard')
      }
    }
    
  } catch (error) {
    // If an error occurs (e.g., unauthenticated), reset the auth store
    store.isAuthenticated = false
    store.user = null
    store.permissions = []
    store.roles = []
  }

  if (authRequired && !store.isAuthenticated) {
    next('/login');
  }else if (to.meta.role && !store.roles[0].includes(to.meta.role)) {
    next('/login');
  }else {
    next();
  }
})

export default { router, simpleAcl }
