<x-app-layout>
    <div class="container mx-auto px-6 py-8 mt-20">
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Form for Editing Leave Type -->
            <form action="{{ route('admin.leavetype.update', $leaveTypes->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Method required for updating -->

                <!-- Leave Name -->
                <div class="mb-4">
                    <label for="leave_name" class="block text-sm font-medium text-gray-700">Leave Name</label>
                    <input type="text" name="leave_name" id="leave_name" value="{{ old('leave_name', $leaveTypes->leave_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <!-- Employee Selection -->
                <div class="mb-4">
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label>
                    <select name="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $leaveTypes->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Requires Attachment -->
                <div class="mb-4">
                    <label for="requires_attachment" class="block text-sm font-medium text-gray-700">Requires Attachment</label>
                    <input type="checkbox" name="requires_attachment" id="requires_attachment" value="1" {{ $leaveTypes->requires_attachment ? 'checked' : '' }} class="mt-1">
                </div>

                <!-- Auto Increase Entitlement -->
                <div class="mb-4">
                    <label for="auto_increase_entitlement" class="block text-sm font-medium text-gray-700">Auto Increase Entitlement</label>
                    <input type="checkbox" name="auto_increase_entitlement" id="auto_increase_entitlement" value="1" {{ $leaveTypes->auto_increase_entitlement ? 'checked' : '' }} class="mt-1">
                </div>

                <!-- Increase Rate -->
                <div class="mb-4">
                    <label for="increase_rate" class="block text-sm font-medium text-gray-700">Increase Rate (days/year)</label>
                    <input type="number" name="increase_rate" id="increase_rate" value="{{ old('increase_rate', $leaveTypes->increase_rate) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-start space-x-4 mt-4">
                    <!-- Back Button -->
                    <a href="{{ route('admin.leavetype.index') }}"
                        class="bg-gray-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Back
                    </a>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>