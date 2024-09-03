<x-app-layout>
  <div class="mt-20">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container p-20">
        <div class="bg-white shadow-md rounded my-6 p-10">
          <form method="POST" action="{{ route('admin.employee.store') }}">
            <div style="display: flex; justify-content:center; padding:2%; margin-bottom: 5%;">
              <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full w-20 h-20">
            </div>
            @csrf
            @method('post')
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

                <!-- Position -->
                <div class="flex flex-col space-y-2">
                  <label for="position_id" class="text-gray-600 select-none font-medium ml-3">Position</label>
                  <select id="position_id" name="position_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <option value="" disabled selected>Select Position</option>
                    @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
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
              <button type="submit" class="w-5px mt-5 bg-red-500 text-red font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style=" border-radius: 5px"><a href="/admin/employee" style="text-decoration: none; color: white;">Cancel</a></button>
              <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>