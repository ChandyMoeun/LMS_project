<x-app-layout>
    <div class="mt-20 p-2">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 ">
            <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center ml-7 mr-7">
                <a href="/admin/position">
                    <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-1/4"><b>Edit Position</b></h1>
            </div>
            <div class="container mx-auto px-6 py-1 mt-10 px-9">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.position.update', $position->id) }}">
                        @csrf
                        @method('put')

                        <!-- Position Name -->
                        <div class="flex flex-col space-y-2 mb-4">
                            <label for="name" class="text-gray-700 select-none font-medium">Position Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $position->name) }}"
                                placeholder="Enter position name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="flex flex-col space-y-2 mb-4">
                            <label for="department_id" class="text-gray-700 select-none font-medium">Department</label>
                            <select id="department_id" name="department_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $position->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center space-x-4 mt-4">
                            <button type="submit" class="bg-yellow-400 text-white font-bold px-3 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>