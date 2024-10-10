<x-app-layout>
    <div class="mt-20 p-5">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center ml-7 mr-7">
                <a href="/admin/department">
                    <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-1/4"><b>New Department</b></h1>
            </div>
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.department.store') }}">
                        @csrf

                        <!-- Department Name -->
                        <div class="flex flex-col space-y-2 mb-4">
                            <label for="name" class="text-gray-700 select-none font-medium">Department Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter department name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-2 mb-4">
                            <label for="manager_id" class="block text-gray-700 text-sm font-bold mb-2">Manager</label>
                            <select name="manager_id" id="manager_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select a manager</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- form Button -->
                        <div class="flex justify-center space-x-4 mt-4">
                            <!-- Save button -->
                            <button type="submit" class="bg-yellow-400 text-white font-bold px-5 py-2 rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>