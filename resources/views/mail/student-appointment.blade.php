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
        <p>
            Hello {{$name}},    
        </p>

        <p>
            Your group, {{$groupCode}}, has been scheduled for an appointment on {{$dateTime}}.
        </p>
    </div>
</body>
</html>