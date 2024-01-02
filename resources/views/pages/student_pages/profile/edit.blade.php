<x-layout>
    <x-page-title>Change Profile Picture</x-page-title>

    <form method="POST" action="{{route('profile.update', ['profile' => auth()->user()->student->id])}}" class="grid grid-cols-1" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- <label class="flex justify-start" for="profile_picture">
            Upload Image
        </label> --}}

        <div id="fileInputParent" class="relative w-full flex justify-center items-center z-[1] px-2 py-1 border border-1 rounded-md hover:ring-1 bg-white outline-none disabled:bg-gray-2 transition-all" data-type="image">
            <div data-file-part="cta" class="flex flex-col justify-center items-center w-full h-full p-10 gap-3">
                <div class="flex p-2 border border-gray-3 rounded-md fill-gray-500">
                    <box-icon name='upload'></box-icon>
                </div>

                <div class="flex flex-col items-center justify-center">
                    @isset(auth()->user()->student->profile_picture)
                        <img class="aspect-square object-cover" src="{{ isset(auth()->user()->student->profile_picture) ? asset('storage/' . auth()->user()->student->profile_picture) : null }}" alt="Profile Picture" >
                        
                    @endisset
                    <span class="text-gray-500 text-center"><span class="text-accent font-bold">Click to upload</span> or drag and drop</span>
                </div>
            </div>

            <input class="absolute top-0 left-0 w-full h-full cursor-pointer disabled:cursor-default opacity-0" type="file" id="profile_picture" name="profile_picture">
            
            @error('profile_picture')
                <p class="col-start-2 text-red-400 italic text-sm absolute top-full left-0 mt-1">{{ $message }}</p>
            @enderror

        </div>
        
        <div class="flex gap-3 items-center">
            <a href="{{route('profile.index')}}" class="button outline w-fit mt-8 h-fit">Cancel</a>
            <button class="button default w-fit mt-8 h-fit">Save</button>
        </div>
    </form>

    @vite('resources/js/file_upload.js')



</x-layout>
