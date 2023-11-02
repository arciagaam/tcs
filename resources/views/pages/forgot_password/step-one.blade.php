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
            <h2 class="text-4xl font-bold">Forgot Password</h2>

            <form action="{{route('forgot-password.post.step-one')}}" method="POST" class="flex flex-col gap-2">
                @csrf
                <div class="input-group">
                    <label for="email" class="label">Enter your email</label>
                    <div class="input">
                        <box-icon name='envelope'></box-icon>
                        <input type="text" id="email" name="email" placeholder="Enter Email" class="w-full focus:outline-none">
                    </div>
                </div>

                @if (session()->has('error'))
                    <p class="text-xs italic text-red-400">{{session('error')}}</p>
                @endif

                @error ('email')
                    <p class="text-xs italic text-red-400">{{$message}}</p>
                @endif

                <button class="async w-full mt-4 button default">Continue</button>

            </form>
        </div>

    </div>

    @vite('resources/js/asyncButton.js')
</body>
</html>