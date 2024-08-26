<x-app-layout>
    <main class="mt-20">
        <div class="p-6 bg-gray-50">
            <!-- Employee Management Header -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold">Employee Management</h2>
                <p class="text-gray-600">Total Employees: 30</p>
            </div>

            <!-- Search and Filter -->
            <div class="flex justify-between mb-4">
                <input type="text" placeholder="Search employee by name..." class="border rounded p-2 w-1/3">
                <div class="flex items-center space-x-2">
                    <select class="border rounded p-2">
                        <option>All positions</option>
                        <option>Front-end</option>
                        <option>Back-end</option>
                        <option>Full-stack</option>
                    </select>
                    <button class="bg-gray-300 rounded p-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add
                    </button>
                </div>
            </div>

            <!-- Employee Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md rounded">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Profile</th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Position</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Repeatable Row Start -->
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <td class="p-3">1</td>
                            <td class="p-3">
                                <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full w-8 h-8">
                            </td>
                            <td class="p-3">Kris Wang</td>
                            <td class="p-3 text-blue-600">kriswang@gmail.com</td>
                            <td class="p-3">Front-end</td>
                            <td class="p-3">
                                <a href="#" class="text-gray-600 hover:underline">More</a>
                                <a href="#" class="ml-2 text-blue-600 hover:underline">Update</a>
                                <a href="#" class="ml-2 text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <!-- Repeatable Row End -->

                        <!-- Repeat the above row for each employee -->
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</x-app-layout>