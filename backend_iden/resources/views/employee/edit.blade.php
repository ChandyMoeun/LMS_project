<x-app-layout>
  <div class="mt-10 p-5">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container p-5">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-5">
          <a href="/admin/employee">
            <svg class="mb-5 w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
          </a>
          <h1 class="font-bold mr-20 text-3xl mt-5 hover:text-yellow-400"><b>Update Employee </b></h1>
        </div>
        <div class="bg-white shadow-md rounded my-6 p-10">
          <form method="POST" action="{{ route('admin.employee.update', $employee) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Profile Image Display and Upload -->
            <div class="flex flex-col items-center mb-4">
              <!-- Profile Image Display -->
              <div class="relative">
                <img id="profile-image" src="{{ $employee->profile ? asset('images/' . $employee->profile) : asset('images/default_profile.png') }}"
                  alt="Profile Picture"
                  class="w-30 h-30 rounded-full object-cover cursor-pointer"
                  style="width: 120px; height: 120px; object-fit: cover;" />
                <!-- Hidden File Input -->
                <input id="profile" type="file" name="profile" class="hidden" onchange="updateProfileImage(this)">
              </div>

              <!-- Profile Image Upload -->
              <div class="flex flex-col items-center mb-4">
                <label for="profile" class="text-gray-700 font-medium mb-2 cursor-pointer">Update Profile</label>
              </div>

              <!-- Form Fields -->
              <div style="display: flex; justify-content:center; justify-content: space-between; width:100%;">
                <div style="width:48%;">
                  <!-- Staff ID -->
                  <div class="flex flex-col space-y-2">
                    <label for="staff_id" class="text-gray-700 select-none font-medium ml-3">Staff ID</label>
                    <input id="staff_id" type="text" name="staff_id" value="{{ old('staff_id', $employee->staff_id) }}"
                      placeholder="Enter Staff ID" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Full Name -->
                  <div class="flex flex-col space-y-2">
                    <label for="full_name" class="text-gray-700 select-none font-medium ml-3">Full Name</label>
                    <input id="full_name" type="text" name="full_name" value="{{ old('full_name', $employee->full_name) }}"
                      placeholder="Enter Full Name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Gender -->
                  <div class="flex flex-col space-y-2">
                    <label for="gender" class="text-gray-700 select-none font-medium ml-3">Gender</label>
                    <select id="gender" name="gender" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                      <option value="" disabled>Select Gender</option>
                      <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                  </div>

                  <!-- Email -->
                  <div class="flex flex-col space-y-2">
                    <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $employee->email) }}"
                      placeholder="Enter Email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Password -->
                  <div class="flex flex-col space-y-2">
                    <label for="password" class="text-gray-700 select-none font-medium">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>
                </div>
                <div style="width:48%;">
                  <!-- Confirm Password -->
                  <div class="flex flex-col space-y-2">
                    <label for="password_confirmation" class="text-gray-700 select-none font-medium ml-3">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Date of Birth -->
                  <div class="flex flex-col space-y-2">
                    <label for="dob" class="text-gray-700 select-none font-medium ml-3">Date of Birth</label>
                    <input id="dob" type="date" name="dob" value="{{ old('dob', $employee->dob) }}"
                      class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Joined Date -->
                  <div class="flex flex-col space-y-2">
                    <label for="joined_date" class="text-gray-700 select-none font-medium ml-3">Joined Date</label>
                    <input id="joined_date" type="date" name="joined_date" value="{{ old('joined_date', $employee->joined_date) }}"
                      class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                  </div>

                  <!-- Position -->
                  <div class="flex flex-col space-y-2">
                    <label for="position_id" class="text-gray-700 select-none font-medium ml-3">Position</label>
                    <select id="position_id" name="position_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                      <option value="" disabled>Select Position</option>
                      @foreach($positions as $position)
                      <option value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Department -->
                  <div class="flex flex-col space-y-2">
                    <label for="department_id" class="text-gray-700 select-none font-medium ml-3">Department</label>
                    <select id="department_id" name="department_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                      <option value="" disabled>Select Department</option>
                      @foreach($departments as $department)
                      <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                      </option>
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
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"
                      {{ in_array($role->id, $employee->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">{{ $role->name }}</span>
                  </label>
                </div>
                @endforeach
              </div>
              <!-- Submit Button -->
              <div class="flex justify-center text-center mt-16 gap-5 mb-16">
                <a href="/admin/employee" class="w-5px mt-5 bg-red-500 text-white font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style="border-radius: 5px;">Cancel</a>
                <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style="border-radius: 5px;">Submit</button>
              </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>


<!-- Upload profile -->
<script>
  // Function to trigger file input when image is clicked
  document.getElementById('profile-image').addEventListener('click', function() {
    document.getElementById('profile').click();
  });

  // Function to update profile image preview
  function updateProfileImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profile-image').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>