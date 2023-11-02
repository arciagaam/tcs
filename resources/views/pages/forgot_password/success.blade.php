<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
</head>
<body class="w-full h-screen">

    <div class="flex items-center justify-center w-full h-full">

        <div class="flex items-center justify-center w-1/2 h-full bg-primary-800">

            <div class="flex flex-col items-center gap-4">
                <img class=" h-[200px] w-fit aspect-square bg-white rounded-full flex items-center justify-center overflow-hidden" src="{{asset('images/logo.png')}}">
                <div class="flex flex-col items-center gap-1 text-2xl font-bold text-white text-center">
                    <h2>College of Computer Studies</h2>
                    <h2>Laguna State Polytechnic University</h2>
                    <h2>Sta Cruz Laguna</h2>
                </div>
            </div>
            
        </div>

        <div class="flex flex-col w-1/2 gap-5 p-14">
            <h2 class="text-4xl font-bold">Password Changed!</h2>
            <p>Your password has been changed successfully.</p>

            <a href="{{route('login')}}" class="button default">Back to Login</a>

        </div>

    </div>

    @vite('resources/js/asyncButton.js')
</body>
</html>