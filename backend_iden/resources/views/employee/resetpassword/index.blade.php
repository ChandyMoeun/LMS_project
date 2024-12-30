<x-app-layout>
    <main class="mt-10 p-10">
        <div class="d-flex border-b-2 px-8 border-gray-300 h-15 mb-16 items-center">
            <a href="/admin/mail">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-5/12"><b>Reset Password for Employees</b></h1>
        </div>
        @if ($employees->isEmpty())
        <p>No employees found.</p>
        @else
        <div class="relative mx-4 mb-3 lg:mx-0">
            <a class="absolute inset-y-0 left-0 pl-3 flex items-center">
              <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                  <path
                     d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  </path>
              </svg>
            </a>    
          <input id="searchInput" onkeyup="filterTable()" class="form-input w-32 h-9 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"placeholder="Search emolyee name...">
        </div>
        <table id="reset_password" class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-black text-white">
                <tr>
                    <th class="py-3 px-5 text-left text-sm font-medium border-b">ID</th>
                    <th class="py-3 px-5 text-center text-sm font-medium border-b">Name</th>
                    <th class="py-3 px-5 text-center text-sm font-medium border-b">Email</th>
                    <th class="py-3 px-5 text-center w-3/12 text-sm font-medium border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ $employee->staff_id }}</td>
                    <td class="py-3 px-5 text-sm text-center border-b">{{ $employee->full_name }}</td>
                    <td class="py-3 px-5 text-sm text-center text-gray-600 border-b">{{ $employee->email }}</td>
                    <td class="py-3 px-5 text-center text-sm text-gray-600 border-b">
                        <a href="{{ route('admin.employee.resetpassword.form', ['id' => $employee->id]) }}" class="inline-block bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-400 transition duration-300">
                            Reset Password
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </main>
    <script>
    // Filter search employees by name and by id
    function filterTable() {
      var input = document.getElementById("searchInput").value.toUpperCase();
      var table = document.getElementById("reset_password");
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