<x-app-layout>
  <div class="mt-10 p-5">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-5">
        <a href="/admin/roles">
          <svg class="w-6 h-6 mt-5 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </a>
        <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-2/12"><b>Edit Role</b></h1> 
      </div>
      <div class="container mx-auto px-6 py-1">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form method="POST" action="{{ route('admin.roles.update',$role->id)}}">
            @csrf
            @method('put')
            <div class="flex flex-col space-y-2 m-5">
              <label for="role_name" class="text-gray-700 select-none font-medium">Role Name</label>
              <input
                id="role_name"
                type="text"
                name="name"
                value="{{ old('name',$role->name) }}"
                placeholder="Placeholder"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
            </div>

            <strong><h1 class="text-xl text-center mt-10 my-4 text-gray-600">Permissions</h1></strong>
            <div class="grid grid-cols-3 gap-4 m-10">
              @foreach($permissions as $permission)
              <div class="flex flex-col justify-cente">
                <div class="flex flex-col">
                  <label class="inline-flex items-center mt-3">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="permissions[]" value="{{$permission->id}}" @if(count($role->permissions->where('id',$permission->id)))
                    checked
                    @endif
                    ><span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                  </label>
                </div>
              </div>
              @endforeach
            </div>
            <div class="text-center mt-5">
              <button type="submit" class="bg-black text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">Update</button>
            </div>
        </div>
      </div>
    </main>
  </div>
  </div>
</x-app-layout>