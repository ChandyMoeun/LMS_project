<x-app-layout>
  <div class="mt-10 p-5">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="d-flex border-b-2 border-gray-300 m-7 h-13 items-center">
            <a href="/admin/permissions">
                <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-3/12"><b>Edit Permission</b></h1>
        </div>
      <div class="container px-8 py-1">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form method="POST" action="{{ route('admin.permissions.update',$permission->id)}}">
            @csrf
            @method('put')
            <div class="flex flex-col space-y-2">
              <label for="role_name" class="text-gray-700 select-none font-medium">Permission Name</label>
              <input
                id="role_name"
                type="text"
                name="name"
                value="{{ old('name',$permission->name) }}"
                placeholder="Enter permission"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>
            <div class="text-center mt-16">
              <button type="submit" class="bg-yellow-400 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-black transition-colors ">Update</button>
            </div>
        </div>


      </div>
    </main>
  </div>
  </div>
</x-app-layout>