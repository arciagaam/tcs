<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="w-full h-screen overflow-hidden">

    <div class="flex w-full h-full">

        <div class="flex items-center justify-center w-1/2 h-full bg-primary-800">

            <div class="flex flex-col items-center gap-4">
                <img class=" h-[200px] w-fit aspect-square bg-white rounded-full flex items-center justify-center overflow-hidden"
                    src="{{ asset('images/logo.png') }}">
                <div class="flex flex-col items-center gap-1 text-2xl font-bold text-white">
                    <h2>College of Computer Studies</h2>
                    <h2>Laguna State Polytechnic University</h2>
                    <h2>Sta Cruz Laguna</h2>
                </div>
            </div>

        </div>

        <div class="flex flex-col w-1/2 gap-5 p-16 overflow-auto">
            <h2 class="text-4xl font-bold">Sign up</h2>
            <p class="text-sm">Already have an account? <a href="{{ route('login') }}"
                    class="underline text-primary-800">Log in here.</a></p>

            <form action="{{ route('post.register') }}" method="POST" class="flex flex-col gap-5"
                enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2 input-group">
                        <label for="thesis_title" class="label">Thesis Title</label>
                        <input type="text" id="thesis_title" name="thesis_title"
                            placeholder="Enter your thesis title" class="input" value="{{ old('thesis_title') }}">
                        @error('thesis_title')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 input-group">
                        <label for="group_code" class="label">Group Code</label>
                        <input type="text" id="group_code" name="group_code" placeholder="Enter Group Code"
                            class="input" value="{{ old('group_code') }}">
                        @error('group_code')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="first_name" class="label">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter your first name"
                            class="input" value="{{ old('first_name') }}">
                        @error('first_name')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="middle_name" class="label">Middle Name <span
                                class="ml-1 text-xs text-black/30 text-start">optional</span></label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name"
                            class="input" value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="last_name" class="label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter your last name"
                            class="input" value="{{ old('last_name') }}">
                        @error('last_name')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email" class="label">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email"
                            class="input" value="{{ old('email') }}">
                        @error('email')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password" class="label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="input">
                        @error('password')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="confirm_password" class="label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Confirm your password" class="input">
                        @error('confirm_password')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="year" class="label">Year</label>
                        <input type="text" id="year" name="year" class="input"
                            value="{{ old('year') }}">
                        @error('year')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="section" class="label">Section</label>
                        <input type="text" id="section" name="section" class="input"
                            value="{{ old('section') }}">
                        @error('section')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <hr>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-full input-group">
                            <label class="label" for="ta_user_id">Thesis Adviser</label>
                            <select name="ta_user_id" id="ta_user_id" class="input">
                                <option value="">Select Thesis Adviser</option>
                                @foreach ($taTeachers as $user)
                                    <option @selected(old('ta_user_id') == $user->id) value="{{ $user->id }}">{{ $user->first_name }}
                                        {{ $user->middle_name ?? '' }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @error('ta_user_id')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror

                            @error('ta_iso')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="ta_iso"
                            class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                            <div class="flex gap-2 whitespace-nowrap">
                                <box-icon name='upload'></box-icon>
                                <p>Upload ISO Form</p>
                            </div>
                            <input id="ta_iso" name="ta_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                        </label>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-full input-group">
                            <label class="label" for="te_user_id">Technical Editor</label>
                            <select name="te_user_id" id="te_user_id" class="input">
                                <option value="">Select Technical Editor</option>
                                @foreach ($teTeachers as $user)
                                    <option @selected(old('te_user_id') == $user->id) value="{{ $user->id }}">{{ $user->first_name }}
                                        {{ $user->middle_name ?? '' }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @error('te_user_id')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror

                            @error('te_iso')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="te_iso"
                            class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                            <div class="flex gap-2 whitespace-nowrap">
                                <box-icon name='upload'></box-icon>
                                <p>Upload ISO Form</p>
                            </div>
                            <input id="te_iso" name="te_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                        </label>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-full input-group">
                            <label class="label" for="se_user_id">System Expert</label>
                            <select name="se_user_id" id="se_user_id" class="input">
                                <option value="">Select System Expert</option>
                                @foreach ($seTeachers as $user)
                                    <option @selected(old('se_user_id') == $user->id) value="{{ $user->id }}">{{ $user->first_name }}
                                        {{ $user->middle_name ?? '' }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @error('se_user_id')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror

                            @error('se_iso')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="se_iso"
                            class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                            <div class="flex gap-2 whitespace-nowrap">
                                <box-icon name='upload'></box-icon>
                                <p>Upload ISO Form</p>
                            </div>
                            <input id="se_iso" name="se_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                        </label>
                    </div>
                </div>

                <button class="w-full button default">Register</button>
            </form>
        </div>

    </div>
</body>

</html>

@vite('resources/js/ISOInput.js')
