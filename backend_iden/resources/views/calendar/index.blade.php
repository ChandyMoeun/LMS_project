<x-app-layout>
    <main class="m-5 mt-20">
        <div class="text-right pt-5">
            @can('Calendar create')
            <a href="{{ route('admin.calendar_workday.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Add Work/time</a>
            @endcan
            
        </div>

        



        <!-- Add your calendar HTML here -->
        <div class="card card-calendar">
            <div class="card-body p-3">
                <div id="calendar"></div>
            </div>
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