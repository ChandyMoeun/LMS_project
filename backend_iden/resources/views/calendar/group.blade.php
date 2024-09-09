<!DOCTYPE html>
<html>

<head>
    <title>Calendar Groups</title>
</head>

<body>
    <h1>Calendar Groups</h1>

    @if($calendarGroups->isEmpty())
    <p>No calendar groups found.</p>
    @else
    <ul>
        @foreach($calendarGroups as $group)
        <li>
            <strong>{{ $group->calendar_name }}</strong> (Year: {{ $group->for_year }})
            <ul>
                <li>Holiday: {{ $group->holiday->holiday_name ?? 'N/A' }}-{{$group->holiday->from_date ?? 'N/A'}}</li> <!-- Assuming 'name' is a field in CalendarHoliday -->

            </ul>
            <ul>
                <li>Work Day: {{ $group->workDay->start_time ?? 'N/A' }}-{{$group->workDay->end_time ?? 'N/A'}}</li> <!-- Assuming 'name' is a field in CalendarWorkDay -->
                
            </ul>
        </li>
        @endforeach
    </ul>
    @endif
</body>

</html>