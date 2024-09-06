<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Holidays List</h1>
    <ul>
        @foreach($holidays as $holiday)
        <li>{{ $holiday->from_date }} - {{ $holiday->to_date }}</li>
        @endforeach
    </ul>
</body>

</html>