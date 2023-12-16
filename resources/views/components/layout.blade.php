<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="BASE_PATH" content="{{ url('/') }}">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <title>TCS</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen text-black bg-[#fafafa]">
    <x-toast />
    <x-top-navbar />
    <x-navbar />
    
    <div class="flex ml-[16rem] pt-[5.25rem] p-5 flex-col min-h-[calc(100vh-4rem)] gap-10">
        {{$slot}}
    </div>
</body>
</html>     