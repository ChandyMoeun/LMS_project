<x-app-layout>
    <main class="p-12 mt-10">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-15 items-center">
            <h1 class="font-bold text-3xl mt-7 hover:text-yellow-400 w-2/12"><b>Calendar</b></h1>
        </div>
        <!-- Rout Calendar_workday -->
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-end space-x-4">
                @can('Calendar create')
                <a href="{{ route('admin.calendar_workday.create') }}"
                    class="bg-black text-white font-bold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-400 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Add Work/Time
                </a>
                @endcan

                @can('Calendar create')
                <a href="{{ route('admin.calendar_holiday.create') }}"
                    class="text-white font-bold px-5 py-2 rounded-lg shadow-md bg-blue-500 hover:bg-blue-400 transition-colors focus:outline-none focus:ring-2 focus:ring-green-300">
                    Add Holiday
                </a>
                @endcan
            </div>
        </div>

        <!-- Add your calendar HTML here -->
        <div class="container mx-auto">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-4">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>


        <!-- Display Workdays Here -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-5">
            <h2 class="text-2xl font-bold mb-4">Workdays and Times</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Day</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day Type</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($calendarWorkDays as $workday)
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $workday->work_day }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $workday->start_time }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $workday->end_time}}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $workday->day_type }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 text-right">
                            @can('Calendar edit')
                            <a href="{{ route('admin.calendar_workday.edit', $workday->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600 text-white">Edit</a>
                            @endcan

                            @can('Calendar delete')
                            <form action="{{ route('admin.calendar_workday.destroy', $workday->id) }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <button class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-600">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Display Holidays Here -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-5">
            <h2 class="text-2xl font-bold mb-4">Holidays</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holiday Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holiday Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($calendarHolidays as $holiday)
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $holiday->holiday_name }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $holiday->from_date }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $holiday->to_date}}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $holiday->holiday }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $holiday->description }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 text-right">
                            @can('Calendar edit')
                            <a href="{{ route('admin.calendar_holiday.edit', $holiday->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600 text-white">Edit</a>
                            @endcan

                            @can('Calendar delete')
                            <form action="{{ route('admin.calendar_holiday.destroy', $holiday->id) }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <button class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-600">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title', // Title in the header (normally on the left)
                center: '',
                end: 'today prev,next' // Navigation buttons (normally on the right)
            },
            selectable: true,
            editable: true,
            events: [{
                    title: 'Call with Dave',
                    start: '2024-08-01',
                    end: '2024-08-01',
                    className: 'bg-gradient-danger'
                },
                // Add other events here...
            ],
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

        calendar.render();
    });
</script>