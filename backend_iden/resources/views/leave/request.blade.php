<x-app-layout>
    <main class="mt-20">
        <div class="container mx-auto px-6 py-4">
            <!-- Leave Request Form -->
            <form method="POST" action="{{ route('admin.leave.store') }}" enctype="multipart/form-data">
                @csrf <!-- CSRF token for security -->

                <!-- Select Employee -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label>
                    <select name="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Select an Employee</option>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->full_name }} | Role: {{ $employee->roles->pluck('name')->join(', ') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Leave Type -->
                <div class="mt-4">
                    <label for="leave_type_id" class="block text-sm font-medium text-gray-700">Leave Type</label>
                    <select name="leave_type_id" id="leave_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">Select Leave Type</option>
                        @foreach($leaveTypes as $leaveType)
                        <option value="{{ $leaveType->id }}" {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>
                            {{ $leaveType->leave_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('leave_type_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- From Date/Time -->
                <div class="mt-4">
                    <label for="from_date" id="from_date_label" class="block text-sm font-medium text-gray-700">From Date/Time</label>
                    <input type="datetime-local" name="from_date" id="from_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('from_date') }}" required>
                </div>

                <!-- To Date/Time -->
                <div class="mt-4">
                    <label for="to_date" id="to_date_label" class="block text-sm font-medium text-gray-700">To Date/Time</label>
                    <input type="datetime-local" name="to_date" id="to_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('to_date') }}" required>
                </div>

                <!-- Leave Duration (Full Day, Half Day, Custom Time) -->
                <div class="mt-4">
                    <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Duration</label>
                    <select name="leave_type" id="leave_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="full_day">Full Day</option>
                        <option value="half_day">Half Day</option>
                        <option value="time">Specific Time</option>
                    </select>
                </div>

                <!-- Half Day Type (Morning, Afternoon) -->
                <div id="halfDayType" class="mt-4" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700">Select Half Day Type</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="half_day_type" value="morning" class="form-radio text-blue-600">
                            <span class="ml-2">Morning</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="half_day_type" value="afternoon" class="form-radio text-blue-600">
                            <span class="ml-2">Afternoon</span>
                        </label>
                    </div>
                </div>

                <!-- Reason -->
                <div class="mt-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                    <textarea name="reason" id="reason" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4" placeholder="Enter the reason for your leave">{{ old('reason') }}</textarea>
                </div>

                <!-- Duration -->
                <div class="mt-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration (in days)</label>
                    <input type="number" name="duration" id="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('duration') }}" min="1" step="0.5" placeholder="Enter duration in days">
                </div>

                <!-- Attachment -->
                <div class="mt-4">
                    <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
                    <input type="file" name="attachment" id="attachment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors">
                        Request Leave
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>

<script>
    const leaveType = document.getElementById('leave_type');
    const halfDayType = document.getElementById('halfDayType');

    const fromDateLabel = document.getElementById('from_date_label');
    const toDateLabel = document.getElementById('to_date_label');
    const fromDateInput = document.getElementById('from_date');
    const toDateInput = document.getElementById('to_date');

    // Event listener to show or hide fields based on leave duration type
    leaveType.addEventListener('change', function() {
        if (this.value === 'time') {
            fromDateLabel.textContent = 'From Time';
            fromDateInput.type = 'time';
            toDateLabel.textContent = 'To Time';
            toDateInput.type = 'time';
            halfDayType.style.display = 'none';
        } else if (this.value === 'half_day') {
            fromDateLabel.textContent = 'From Date';
            fromDateInput.type = 'date';
            toDateLabel.textContent = 'To Date';
            toDateInput.type = 'date';
            halfDayType.style.display = 'block';
        } else {
            fromDateLabel.textContent = 'From Date/Time';
            fromDateInput.type = 'datetime-local';
            toDateLabel.textContent = 'To Date/Time';
            toDateInput.type = 'datetime-local';
            halfDayType.style.display = 'none';
        }
    });

    // Trigger change event on page load to ensure correct input types are set
    leaveType.dispatchEvent(new Event('change'));
</script>
