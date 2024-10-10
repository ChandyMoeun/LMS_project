<x-app-layout>
    <main class="mt-10 p-5 ">
        <div class="d-flex border-b-2 border-gray-300 m-5    px-8 h-15 items-center">
            <a href="/admin/calendar_workday">
                <svg class="w-6 h-6 mt-3 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-2/6"><b>Add Working Days</b></h1>
        </div>
        <div class="container mx-auto px-6 py-8 mt-10">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('admin.calendar_workday.store') }}">
                    @csrf
                    @method('POST')

                    <!-- Work Day -->
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="work_day" class="text-gray-700 select-none font-medium">Work Day</label>
                        <select id="work_day" name="work_day"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <option value="" disabled {{ old('work_day') ? '' : 'selected' }}>Select a day</option>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" {{ old('work_day') == $day ? 'selected' : '' }}>
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
                        <input id="start_time" type="time" name="start_time" value="{{ old('start_time') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        @error('start_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="end_time" class="text-gray-700 select-none font-medium">End Time</label>
                        <input id="end_time" type="time" name="end_time" value="{{ old('end_time') }}"
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
                            <option value="" disabled {{ old('day_type') ? '' : 'selected' }}>Select type</option>
                            <option value="full_day" {{ old('day_type') == 'full_day' ? 'selected' : '' }}>Full Day</option>
                            <option value="morning" {{ old('day_type') == 'morning' ? 'selected' : '' }}>Morning</option>
                            <option value="afternoon" {{ old('day_type') == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                        </select>
                        @error('day_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Submit Button -->
                        <button type="submit" class="bg-yellow-400 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-black transition-colors">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>