<x-app-layout>
    <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.position.store') }}">
                        @csrf

                        <!-- Position Name -->
                        <div class="flex flex-col space-y-2 mb-4">
                            <label for="name" class="text-gray-700 select-none font-medium">Position Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
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
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-start space-x-4 mt-4">
                            <!-- Back Button -->
                            <a href="{{ route('admin.position.index') }}"
                                class="bg-gray-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Back
                            </a>
                            <!-- Submit Button -->
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>