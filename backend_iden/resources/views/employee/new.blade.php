<x-app-layout>
  <div class="mt-10">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container p-20">
        <a href="/admin/employee">
          <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
          </svg>
        </a>
        <div class="flex border-b-2 border-gray-300 h-20 items-center mb-10">
          <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400"><b>Add Employee </b></h1>
        </div>
        <div class="bg-white shadow-md rounded my-6 p-10">
          <form id="profileForm" method="POST" action="{{ route('admin.employee.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div style="display: flex; justify-content: center; padding: 2%; margin-bottom: 5%;">
              <!-- Hidden file input -->
              <input type="file" id="profileImageInput" name="profile" class="hidden" accept="image/*" onchange="previewImage(event)" />

              <!-- Image element -->
              <img
                id="profileImage"
                src="https://via.placeholder.com/120"
                alt="Profile"
                class="rounded-full w-20 h-20 cursor-pointer"
                onclick="document.getElementById('profileImageInput').click()" />
            </div>

            <script>
              function previewImage(event) {
                const input = event.target;
                const file = input.files[0];

                if (file) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                  };
                  reader.readAsDataURL(file);
                }
              }
            </script>

            <div style="display: flex; justify-content:center; justify-content: space-between; width:100%;">
              <div style="width:48%;">
                <!-- Staff ID -->
                <div class="flex flex-col space-y-2">
                  <label for="staff_id" class="text-gray-600 select-none font-medium ml-3">Staff ID</label>
                  <input id="staff_id" type="text" name="staff_id" value="{{ old('staff_id') }}"
                    placeholder="Enter Staff ID" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Full Name -->
                <div class="flex flex-col space-y-2">
                  <label for="full_name" class="text-gray-600 select-none font-medium ml-3">Full Name</label>
                  <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}"
                    placeholder="Enter Full Name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Gender -->
                <div class="flex flex-col space-y-2">
                  <label for="gender" class="text-gray-600 select-none font-medium ml-3">Gender</label>
                  <select id="gender" name="gender" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>

                <!-- Email -->
                <div class="flex flex-col space-y-2">
                  <label for="email" class="text-gray-600 select-none font-medium ml-3">Email</label>
                  <input id="email" type="email" name="email" value="{{ old('email') }}"
                    placeholder="Enter Email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Password -->
                <div class="flex flex-col space-y-2">
                  <label for="password" class="text-gray-600 select-none font-medium ml-3">Password</label>
                  <input id="password" type="password" name="password" value="{{ old('password') }}"
                    placeholder="Enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>
              </div>

              <div style="width:48%;">
                <!-- Confirm Password -->
                <div class="flex flex-col space-y-2">
                  <label for="password_confirmation" class="text-gray-600 select-none font-medium ml-3">Confirm Password</label>
                  <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Date of Birth -->
                <div class="flex flex-col space-y-2">
                  <label for="dob" class="text-gray-600 select-none font-medium ml-3">Date of Birth</label>
                  <input id="dob" type="date" name="dob" value="{{ old('dob') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Joined Date -->
                <div class="flex flex-col space-y-2">
                  <label for="joined_date" class="text-gray-600 select-none font-medium ml-3">Joined Date</label>
                  <input id="joined_date" type="date" name="joined_date" value="{{ old('joined_date') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>
                <!-- Joined Date -->
                <div class="flex flex-col space-y-2">
                  <label for="entitled_date" class="text-gray-600 select-none font-medium ml-3">Joined Date</label>
                  <input id="entitled_date" type="date" name="entitled_date" value="{{ old('entitled_date') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                </div>

                <!-- Position -->
                <div class="flex flex-col space-y-2">
                  <label for="position_id" class="text-gray-600 select-none font-medium ml-3">Position</label>
                  <select id="position_id" name="position_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <option value="" disabled selected>Select Position</option>
                    @foreach($positions as $position)
                    <option value="{{ $position->id }}" data-department-id="{{ $position->department_id }}">{{ $position->name }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Department -->
                <div class="flex flex-col space-y-2">
                  <label for="department_id" class="text-gray-600 select-none font-medium ml-3">Department</label>
                  <select id="department_id" name="department_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <option value="" disabled selected>Select Department</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <!-- Role Assignment -->
            <h3 class="text-xl my-4 text-gray-600">Role</h3>
            <div class="grid grid-cols-3 gap-4">
              @foreach($roles as $role)
              <div class="flex flex-col justify-center">
                <label class="inline-flex items-center mt-3">
                  <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                </label>
              </div>
              @endforeach
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-16 mb-16">
              <button type="submit" class="w-5px mt-5 bg-red-500 text-white font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style="border-radius: 5px"><a href="/admin/employee" style="text-decoration: none; color: white;">Cancel</a></button>
              <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-blue-400 focus:outline-none focus:bg-blue-700 transition-colors" style="border-radius: 5px">Submit</button>
            </div>
          </form>

        </div>
      </div>
    </main>
  </div>
</x-app-layout>

<script>
  document.getElementById('position_id').addEventListener('change', function() {
    var selectedPosition = this.options[this.selectedIndex];
    var departmentId = selectedPosition.getAttribute('data-department-id');

    // Get the department select element
    var departmentSelect = document.getElementById('department_id');

    // Reset the department select options
    for (var i = departmentSelect.options.length - 1; i >= 0; i--) {
      departmentSelect.remove(i);
    }

    // Add default option
    var defaultOption = document.createElement('option');
    defaultOption.text = 'Select Department';
    defaultOption.value = '';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    departmentSelect.add(defaultOption);

    // Add departments and auto-select the matching one
    @foreach($departments as $department)
    var option = document.createElement('option');
    option.text = '{{ $department->name }}';
    option.value = '{{ $department->id }}';
    departmentSelect.add(option);

    // Auto-select the department if it matches the selected position
    if ('{{ $department->id }}' === departmentId) {
      option.selected = true;
    }
    @endforeach
  });
</script>