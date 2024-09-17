<x-app-layout>
  <div class="mt-10 p-5">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-5">
        <a href="/admin/mail#">
          <svg class="w-6 h-6 mt-5 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </a>
        <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-1/12"><b>Roles </b></h1> 
      </div>
      <div class="container mx-auto px-6 py-2 "> 
        <div class="text-right">
          @can('Role create')
          <a href="{{route('admin.roles.create')}}" class=" bg-black text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors ">New Role</a>
        </div>
        @endcan

        <div class="bg-white c rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead class="bg-black text-white">
              <tr>
                <th class="py-4 px-6 font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Role Name</th>
                <th class="py-4 px-6 text-center font-bold text-sm text-grey-dark border-b border-grey-light">Permissions</th>
                <th class="py-4 px-6 text-center font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Actions</th>
              </tr>
            </thead>
            <tbody>
              @can('Role access')
              @foreach($roles as $role)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ $role->name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">
                  @foreach($role->permissions as $permission)
                  <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">{{ $permission->name }}</span>
                  @endforeach
                </td>
                <td class="py-4 px-6 border-b border-grey-light text-right">

                  @can('Role edit')
                  <a href="{{route('admin.roles.edit',$role->id)}}" class="text-white font-bold py-1 px-3 border rounded text-xs bg-black hover:bg-yellow-400">Edit</a>
                  @endcan

                  @can('Role delete')
                  <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline">
                    @csrf
                    @method('delete')
                    <button class="text-white font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400">Delete</button>
                  </form>
                  @endcan

                </td>
              </tr>
              @endforeach
              @endcan
            </tbody>
          </table>
        </div>

      </div>
    </main>
  </div>
  </div>
</x-app-layout>