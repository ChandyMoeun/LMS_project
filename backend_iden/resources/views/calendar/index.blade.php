<x-app-layout>
    <main class="m-5 mt-20">
        <!-- Rout Calendar_workday -->
        <div class="text-right pt-5">
            @can('Calendar create')
            <a href="{{ route('admin.calendar_workday.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Add Work/time</a>
            @endcan

        </div>


        <div class="text-right pt-5">
            @can('Calendar create')
            <a href="{{ route('admin.calendar_holiday.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Add Holiday</a>
            @endcan

        </div>

        <!-- Add your calendar HTML here -->
        <div class="card card-calendar">
            <div class="card-body p-3">
                <div id="calendar"></div>
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
        <H1>Here is Holiday</H1>
        <div class="text-right pt-5">
            @can('Calendar create')
            <a href="{{ route('admin.calendar_group.index') }}"
                class="inline-block bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">
                See Holidays
            </a>
            @endcan
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
                {
                    title: 'Lunch meeting',
                    start: '2024-08-05',
                    end: '2024-08-05',
                    className: 'bg-gradient-warning'
                },
                {
                    title: 'All day conference',
                    start: '2024-08-10',
                    end: '2024-08-10',
                    className: 'bg-gradient-success'
                },
                {
                    title: 'Meeting with Mary',
                    start: '2024-08-12',
                    end: '2024-08-12',
                    className: 'bg-gradient-info'
                },
                {
                    title: 'Winter Hackathon',
                    start: '2024-08-20',
                    end: '2024-08-20',
                    className: 'bg-gradient-danger'
                },
                {
                    title: 'Digital event',
                    start: '2024-08-22',
                    end: '2024-08-23',
                    className: 'bg-gradient-warning'
                },
                {
                    title: 'Marketing event',
                    start: '2024-08-25',
                    end: '2024-08-25',
                    className: 'bg-gradient-primary'
                },
                {
                    title: 'Dinner with Family',
                    start: '2024-08-28',
                    end: '2024-08-28',
                    className: 'bg-gradient-danger'
                },
                {
                    title: 'Black Friday',
                    start: '2024-08-30',
                    end: '2024-08-30',
                    className: 'bg-gradient-info'
                },
                {
                    title: 'Cyber Week',
                    start: '2024-08-31',
                    end: '2024-08-31',
                    className: 'bg-gradient-warning'
                }
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