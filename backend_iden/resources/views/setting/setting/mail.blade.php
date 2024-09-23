<x-app-layout>
  <div class="mt-10">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-5">
      <div class="container flex flex-col gap-10 mx-auto p-4 px-1  justify-evenly ">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center">
          <h1 class="w-10 font-bold text-3xl mt-5 hover:text-yellow-400"><b>Setting </b></h1>
        </div>
        <div class="flex flex-wrap justify-center ml-10 mr-10">
          <!-- card departments -->
          <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
            <div class="h-48 h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
              <a href="department">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">departments</h5>
              </a>
              <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">Crete, Update, and delete Department.</p>
              <a href="department" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                View more
                <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
              </a>
            </div>
          </div>
          <!-- card leave type -->
          <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
            <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
              <a href="leavetype">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Leave Types</h5>
              </a>
              <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">Types of leave that available employee to take lrave.</p>
              <a href="leavetype" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                View more
                <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
              </a>
            </div>
          </div>
          <!-- card reset password -->
          <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
            <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
              <a href="{{ route('admin.employee.resetpassword.index') }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Reset Password</h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Admin and manager can reset new password for
                each employee.</p>
              <a href="{{ route('admin.employee.resetpassword.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                View more
                <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
              </a>
            </div>
          </div>
          <!-- card rejected leave -->
            <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
              <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
                <a href="position">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Position</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">You can see the leave that you are rejected
                  here and you also can change to approve.</p>
                <a href="position" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                  View more
                  <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                </a>
              </div>
            </div>

          <!-- card rejected leave -->
            <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
              <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
                <a href="{{ route('admin.permissions.index') }}">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Permission</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">You can see the leave that you are rejected
                  here and you also can change to approve.</p>
                <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                  View more
                  <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                </a>
              </div>
            </div>
          <!-- card rejected leave -->
            <div class="flex h-52 w-2/6 dark:bg-gray-800 bg-teal-400 p-3 flex-col">
              <div class="h-48 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 ">
                <a href="{{ route('admin.roles.index') }}">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Role</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">You can see the leave that you are rejected
                  here and you also can change to approve.</p>
                <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-yellow-400">
                  View more
                  <svg class="rtl:rotate-180 ml-2 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                </a>
              </div>
            </div>
        </div>
      </div>
    </main>
  </div>
  </div>
</x-app-layout>