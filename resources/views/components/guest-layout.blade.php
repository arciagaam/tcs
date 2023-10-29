<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Thesis Consultation</title>
        @vite('resources/css/app.css')
    </head>

    <body class="pl-[20vw] pr-10 py-10 h-screen overflow-auto w-full !bg-cover !bg-center bg-no-repeat flex flex-col gap-20" style="background: url({{asset('images/landing.png')}})">
        <div class="flex items-center w-full justify-center gap-5">
            <div class="h-[6rem] aspect-square rounded-full bg-white">
                <img src="{{asset('images/logo.png')}}" class="h-full aspect-square" alt="">
            </div>
    
            <p class="flex flex-col items-center text-white text-lg font-medium">
                <span>College of Computer Studies</span>
                <span>Laguna State Polytechnic University</span>
                <span>Sta Cruz Laguna</span>
            </p>
        </div>
        
        {{$slot}}
        
    </body>
</html>
