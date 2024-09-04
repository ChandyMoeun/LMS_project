<x-app-layout>
    <div class="container mx-auto px-6 py-8 mt-20">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('admin.calendar_holiday.store') }}">
                @csrf
                @method('POST')

                <!-- Holiday Name -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="holiday_name" class="text-gray-700 select-none font-medium">Holiday Name</label>
                    <input id="holiday_name" type="text" name="holiday_name" value="{{ old('holiday_name') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('holiday_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- From Date -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="from_date" class="text-gray-700 select-none font-medium">From Date</label>
                    <input id="from_date" type="date" name="from_date" value="{{ old('from_date') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('from_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- To Date -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="to_date" class="text-gray-700 select-none font-medium">To Date</label>
                    <input id="to_date" type="date" name="to_date" value="{{ old('to_date') }}"
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
                        <option value="" disabled {{ old('holiday') ? '' : 'selected' }}>Select type</option>
                        <option value="national" {{ old('holiday') == 'national' ? 'selected' : '' }}>National</option>
                        <option value="observance" {{ old('holiday') == 'observance' ? 'selected' : '' }}>Observance</option>
                    </select>
                    @error('holiday')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="description" class="text-gray-700 select-none font-medium">Description</label>
                    <textarea id="description" name="description"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-8">
                    <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
