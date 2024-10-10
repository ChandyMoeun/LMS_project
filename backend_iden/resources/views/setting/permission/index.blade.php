<x-app-layout>
  <div class="mt-10 p-5">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="d-flex border-b-2 border-gray-300 px-8 m-7 h-13 items-center">
        <a href="/admin/mail#">
          <svg class="w-6 h-6 mt-5 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </a>
        <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-1/6"><b>Permission </b></h1>
      </div>
      <div class="container mx-auto px-6 py-2">
        <div class="text-right">
          @can('Permission create')
          <a href="{{route('admin.permissions.create')}}" class="bg-black text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors ">New Permission</a>
          @endcan
        </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Permission Name</th>

                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
              </tr>
            </thead>
            <tbody>

              @can('Permission access')
              @foreach($permissions as $permission)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ $permission->name }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right">
                  @can('Permission edit')
                  <a href="{{route('admin.permissions.edit',$permission->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                  @endcan

                  @can('Permission delete')
                  <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="inline">
                    @csrf
                    @method('delete')
                    <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
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