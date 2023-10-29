<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    @vite('resources/css/app.css')

</head>

<body>

    <div class="flex flex-col">
        <h2>Hello {{ $name }},</h2>

        <p>A new appointment request has been scheduled with group {{ $groupCode }} on {{ $dateTime }}.</p>
    </div>

</body>

</html>
