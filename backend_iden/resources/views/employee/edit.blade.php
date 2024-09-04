<x-app-layout>
   <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.employee.update', $employee) }}">
                  @csrf
                  @method('PUT')
                  
                  <!-- Staff ID -->
                  <div class="flex flex-col space-y-2">
                    <label for="staff_id" class="text-gray-700 select-none font-medium">Staff ID</label>
                    <input id="staff_id" type="text" name="staff_id" value="{{ old('staff_id', $employee->staff_id) }}"
                      placeholder="Enter Staff ID" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>

                  <!-- Full Name -->
                  <div class="flex flex-col space-y-2">
                    <label for="full_name" class="text-gray-700 select-none font-medium">Full Name</label>
                    <input id="full_name" type="text" name="full_name" value="{{ old('full_name', $employee->full_name) }}"
                      placeholder="Enter Full Name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>  

                  <!-- Gender -->
                  <div class="flex flex-col space-y-2">
                    <label for="gender" class="text-gray-700 select-none font-medium">Gender</label>
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
                      placeholder="Enter Email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>
                  
                  <!-- Password -->
                  <div class="flex flex-col space-y-2">
                    <label for="password" class="text-gray-700 select-none font-medium">Password</label>
                    <input id="password" type="password" name="password" value="{{old('password', $employee->password)}}" placeholder="Enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>
                  
                  <!-- Confirm Password -->
                  <div class="flex flex-col space-y-2">
                    <label for="password_confirmation" class="text-gray-700 select-none font-medium">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>

                  <!-- Date of Birth -->
                  <div class="flex flex-col space-y-2">
                    <label for="dob" class="text-gray-700 select-none font-medium">Date of Birth</label>
                    <input id="dob" type="date" name="dob" value="{{ old('dob', $employee->dob) }}"
                      class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>

                  <!-- Joined Date -->
                  <div class="flex flex-col space-y-2">
                    <label for="joined_date" class="text-gray-700 select-none font-medium">Joined Date</label>
                    <input id="joined_date" type="date" name="joined_date" value="{{ old('joined_date', $employee->joined_date) }}"
                      class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                  </div>

                  <!-- Position -->
                  <div class="flex flex-col space-y-2">
                    <label for="position_id" class="text-gray-700 select-none font-medium">Position</label>
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
                    <label for="department_id" class="text-gray-700 select-none font-medium">Department</label>
                    <select id="department_id" name="department_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                      <option value="" disabled>Select Department</option>
                      @foreach($departments as $department)
                          <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                              {{ $department->name }}
                          </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Role Assignment -->
                  <h3 class="text-xl my-4 text-gray-600">Role</h3>
                  <div class="grid grid-cols-3 gap-4">
                    @foreach($roles as $role)
                        <div class="flex flex-col justify-center">
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"
                                {{ in_array($role->id, $employee->roles->pluck('id')->toArray()) ? 'checked' : '' }}
                                ><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                            </label>
                        </div>
                    @endforeach
                  </div>

                  <!-- Submit Button -->
                  <div class="text-center mt-16 mb-16">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Update</button>
                  </div>

                </form>
              </div>
            </div>
        </main>
    </div>
</x-app-layout>
