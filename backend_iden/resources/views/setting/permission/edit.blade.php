<x-app-layout>
  <div class="mt-20">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <a href="/admin/permissions">
            <svg class="w-5 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
          </a>
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
              <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update</button>
            </div>
        </div>


      </div>
    </main>
  </div>
  </div>
</x-app-layout>