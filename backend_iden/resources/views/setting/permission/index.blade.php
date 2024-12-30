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
      <div class="flex px-8 mt-10 justify-between">
        <div class="relative mx-4 lg:mx-0">
            <a class="absolute inset-y-0 left-0 pl-3 flex items-center">
              <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                  <path
                     d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  </path>
              </svg>
            </a>    
          <input id="searchInput" onkeyup="filterTable()" class="form-input w-32 h-9 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"placeholder="Search department name...">
        </div>
        @can('Permission create')
        <a href="{{route('admin.permissions.create')}}" class="bg-black text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors ">New Permission</a>
        @endcan
      </div>
      <div class="container mx-auto px-6 py-1">
        <div class="bg-white shadow-md rounded my-6">
          <table id="permission" class="text-left w-full border-collapse">
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
  <script>
    // Filter search employees by name and by id
    function filterTable() {
      var input = document.getElementById("searchInput").value.toUpperCase();
      var table = document.getElementById("permission");
      var tr = table.getElementsByTagName("tr");

      for (var i = 1; i < tr.length; i++) { // Start at 1 to skip the header row
        var tdId = tr[i].getElementsByTagName("td")[0]; // Staff ID column
        var tdName = tr[i].getElementsByTagName("td")[2]; // Name column
        var idMatch = tdId && tdId.textContent.toUpperCase().indexOf(input) > -1;
        var nameMatch = tdName && tdName.textContent.toUpperCase().indexOf(input) > -1;

        if (idMatch || nameMatch) {
          tr[i].style.display = ""; // Show the row
        } else {
          tr[i].style.display = "none"; // Hide the row
        }
      }
    }
  </script>
</x-app-layout>