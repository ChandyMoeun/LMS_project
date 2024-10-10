<x-app-layout>
    <main class="mt-10 p-5">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-15 items-center">
            <a href="/admin/leavetype">
                <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-3/12"><b>Add New Type</b></h1>
        </div>
        <div class="container mx-auto px-6 py-8 mt-5">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('admin.leavetype.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="leave_name" class="block text-sm font-medium text-gray-700">Leave Name</label>
                        <input type="text" name="leave_name" id="leave_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label>
                        <select name="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id}}">{{ $employee->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="requires_attachment" class="block text-sm font-medium text-gray-700">Requires Attachment</label>
                        <input type="checkbox" name="requires_attachment" id="requires_attachment" value="1" class="mt-1">
                    </div>

                    <div class="mb-4">
                        <label for="auto_increase_entitlement" class="block text-sm font-medium text-gray-700">Auto Increase Entitlement</label>
                        <input type="checkbox" name="auto_increase_entitlement" id="auto_increase_entitlement" value="1" class="mt-1">
                    </div>

                    <div class="mb-4">
                        <label for="increase_rate" class="block text-sm font-medium text-gray-700">Increase Rate (days/year)</label>
                        <input type="number" name="increase_rate" id="increase_rate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Submit Button -->
                        <button type="submit" class="bg-yellow-400  text-white font-bold px-5 py-2 rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Add
                        </button>
                    </div>



                </form>

            </div>
        </div>
    </main>
</x-app-layout>