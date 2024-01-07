<x-layout>
    <x-page-title>Edit Profile</x-page-title>

    <form method="POST" action="{{ route('profile.update', ['profile' => auth()->user()->student->id]) }}"
        class="flex flex-col gap-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- <label class="flex justify-start" for="profile_picture">
            Upload Image
        </label> --}}
        <div class="flex gap-5">

            <div id="fileInputParent"
                class="relative w-1/4 aspect-square flex justify-center items-center z-[1] px-2 py-1 border border-1 rounded-md hover:ring-1 bg-white outline-none disabled:bg-gray-2 transition-all"
                data-type="image">
                <div data-file-part="cta" class="flex flex-col justify-center items-center w-full h-full p-10 gap-3">
                    <div class="flex p-2 border border-gray-3 rounded-md fill-gray-500">
                        <box-icon name='upload'></box-icon>
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        @isset(auth()->user()->student->profile_picture)
                            <img class="aspect-square object-cover"
                                src="{{ isset(auth()->user()->student->profile_picture) ? asset('storage/' . auth()->user()->student->profile_picture) : null }}"
                                alt="Profile Picture">
                        @endisset
                        <span class="text-gray-500 text-center"><span class="text-accent font-bold">Click to
                                upload</span>
                            or drag and drop</span>
                    </div>
                </div>

                <input class="absolute top-0 left-0 w-full h-full cursor-pointer disabled:cursor-default opacity-0"
                    type="file" id="profile_picture" name="profile_picture">

                @error('profile_picture')
                    <p class="col-start-2 text-red-400 italic text-sm absolute top-full left-0 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="grid grid-cols-3 gap-5 mt-5">

                <div class="input-group">
                    <label for="first_name" class="label">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name"
                        class="input" value="{{ old('first_name') ?? auth()->user()->first_name }}">
                    @error('first_name')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="middle_name" class="label">Middle Name <span
                            class="ml-1 text-xs text-black/30 text-start">optional</span></label>
                    <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name"
                        class="input" value="{{ old('middle_name') ?? auth()->user()->middle_name }}">
                    @error('middle_name')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="last_name" class="label">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name"
                        class="input" value="{{ old('last_name') ?? auth()->user()->last_name}}">
                    @error('last_name')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="email" class="label">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" class="input"
                        value="{{ old('email') ?? auth()->user()->email }}">
                    @error('email')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="year" class="label">Year</label>
                    <input type="text" id="year" name="year" placeholder="Enter your current year"
                        class="input" value="{{ old('year') ?? auth()->user()->student->year }}">
                    @error('year')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="section" class="label">Section</label>
                    <input type="text" id="section" name="section" placeholder="Enter your current section"
                        class="input" value="{{ old('section') ?? auth()->user()->student->section}}">
                    @error('section')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="group_code" class="label">Group Code</label>
                    <input type="text" id="group_code" name="group_code" placeholder="Enter your current group code"
                        class="input" value="{{ old('group_code') ?? auth()->user()->student->group_code}}">
                    @error('group_code')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="text-xs">warning: changing your group code might affect what you see in the system.</p>
                </div>

                <div class="input-group">
                    <label for="thesis_title" class="label">Thesis title</label>
                    <input type="text" id="thesis_title" name="thesis_title"
                        placeholder="Enter your current thesis title" class="input"
                        value="{{ old('thesis_title') ?? auth()->user()->student->thesis_title }}">
                    @error('thesis_title')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <div class="flex gap-3 items-center">
            <a href="{{ route('profile.index') }}" class="button outline w-fit mt-8 h-fit">Cancel</a>
            <button class="button default w-fit mt-8 h-fit">Save</button>
        </div>
    </form>

    @vite('resources/js/file_upload.js')



</x-layout>
