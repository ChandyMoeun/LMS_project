<x-app-layout>
    <div class="container mx-auto px-6 py-8 mt-20">
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Update Form -->
            <form method="POST" action="{{ route('admin.calendar_holiday.update', $calendarHoliday->id) }}">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->

                <!-- Holiday Name -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="holiday_name" class="text-gray-700 select-none font-medium">Holiday Name</label>
                    <input id="holiday_name" type="text" name="holiday_name" value="{{ old('holiday_name', $calendarHoliday->holiday_name) }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('holiday_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- From Date -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="from_date" class="text-gray-700 select-none font-medium">From Date</label>
                    <input id="from_date" type="date" name="from_date" value="{{ old('from_date', $calendarHoliday->from_date) }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('from_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- To Date -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="to_date" class="text-gray-700 select-none font-medium">To Date</label>
                    <input id="to_date" type="date" name="to_date" value="{{ old('to_date', $calendarHoliday->to_date) }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('to_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Holiday Type -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="holiday" class="text-gray-700 select-none font-medium">Holiday Type</label>
                    <select id="holiday" name="holiday"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <option value="" disabled {{ old('holiday', $calendarHoliday->holiday) ? '' : 'selected' }}>Select type</option>
                        <option value="national" {{ old('holiday', $calendarHoliday->holiday) == 'national' ? 'selected' : '' }}>National</option>
                        <option value="observance" {{ old('holiday', $calendarHoliday->holiday) == 'observance' ? 'selected' : '' }}>Observance</option>
                    </select>
                    @error('holiday')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="description" class="text-gray-700 select-none font-medium">Description</label>
                    <textarea id="description" name="description"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">{{ old('description', $calendarHoliday->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-start space-x-4 mt-4">
                    <a href="{{ route('admin.calendar_workday.index') }}"
                        class="bg-gray-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Back
                    </a>
                    <!-- Update button -->
                    <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>