<!DOCTYPE html>
<html>

<head>
    <title>Calendar Groups</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-4">Calendar Groups</h1>

        @if($calendarGroups->isEmpty())
        <p class="text-gray-600">No calendar groups found.</p>
        @else
        <ul class="space-y-4">
            @foreach($calendarGroups as $group)
            <li class="bg-white shadow-md rounded-lg p-4">
                <div class="flex flex-col">
                    <strong class="text-xl font-semibold">{{ $group->calendar_name }}</strong>
                    <span class="text-gray-700">Year: {{ $group->for_year }}</span>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Holiday:</h3>
                    @if($group->holiday)
                    <ul class="list-disc pl-5 space-y-1">
                        <li><strong>Name:</strong> {{ $group->holiday->holiday_name ?? 'N/A' }}</li>
                        <li><strong>From:</strong> {{ $group->holiday->from_date ?? 'N/A' }}</li>
                        <li><strong>To:</strong> {{ $group->holiday->to_date ?? 'N/A' }}</li>
                        <li><strong>Type:</strong> {{ $group->holiday->holiday ?? 'N/A' }}</li>
                        <li><strong>Description:</strong> {{ $group->holiday->description ?? 'N/A' }}</li>
                    </ul>
                    @else
                    <p class="text-gray-600">No holiday information available.</p>
                    @endif
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Work Day:</h3>
                    @if($group->workDay)
                    <ul class="list-disc pl-5 space-y-1">
                        <li><strong>WorkDay/Time:</strong> {{ $group->workDay->work_day ?? 'N/A' }}</li>
                        <li><strong>Start Time:</strong> {{ $group->workDay->start_time ?? 'N/A' }}</li>
                        <li><strong>End Time:</strong> {{ $group->workDay->end_time ?? 'N/A' }}</li>
                        <li><strong>Day Type:</strong> {{ $group->workDay->day_type ?? 'N/A' }}</li>
                    </ul>
                    @else
                    <p class="text-gray-600">No work day information available.</p>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</body>

</html>