<x-app-layout>
    <div class="container mx-auto px-6 py-8 mt-20">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('admin.calendar_workday.update', $calendarWorkDay->id) }}">
                @csrf
                @method('PUT')

                <!-- Work Day -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="work_day" class="text-gray-700 select-none font-medium">Work Day</label>
                    <select id="work_day" name="work_day"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <option value="{{ $day }}" {{ $calendarWorkDay->work_day == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                        @endforeach
                    </select>
                    @error('work_day')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Start Time -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="start_time" class="text-gray-700 select-none font-medium">Start Time</label>
                    <input id="start_time" type="time" name="start_time" value="{{ $calendarWorkDay->start_time }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('start_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Time -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="end_time" class="text-gray-700 select-none font-medium">End Time</label>
                    <input id="end_time" type="time" name="end_time" value="{{ $calendarWorkDay->end_time }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                    @error('end_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Day Type -->
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="day_type" class="text-gray-700 select-none font-medium">Day Type</label>
                    <select id="day_type" name="day_type"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <option value="full_day" {{ $calendarWorkDay->day_type == 'full_day' ? 'selected' : '' }}>Full Day</option>
                        <option value="morning" {{ $calendarWorkDay->day_type == 'morning' ? 'selected' : '' }}>Morning</option>
                        <option value="afternoon" {{ $calendarWorkDay->day_type == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                    </select>
                    @error('day_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- form Button -->
                <div class="flex justify-start space-x-4 mt-4">
                    <a href="{{ route('admin.calendar_workday.index') }}"
                        class="bg-gray-500 text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Back
                    </a>
                    <!-- Update Button -->
                    <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>