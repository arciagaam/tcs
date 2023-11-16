@php
    $accept = request()->type == 'video' ? "video/mp4,video/x-m4v,video/*" : '*'
@endphp

<x-layout>
    <h2 class="text-2xl font-bold">Submit File/Video</h2>

    <form class="card" action="{{route('panel-members.submissions.store', ['role' => $role])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="type" type="hidden" value="{{request()->type}}">

        <div class="input-group">
            <label for="name" class="label">Submission Name</label>
            <input type="text" id="name" name="name" class="input">
            @error('name')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="input-group">
            <p class="label">Upload File</p>

            <label for="file_submission" class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                <div class="flex gap-2 whitespace-nowrap">
                    <box-icon name='upload'></box-icon>
                    <p>Upload {{ucfirst(request()->type)}}</p>
                </div>
                <input accept="{{$accept}}" id="file_submission" name="file_submission" type="file" class="opacity-0 max-h-0 max-w-0">
            </label>
            @error('file_submission')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <button class="mt-3 button default">Submit {{ucfirst(request()->type)}}</button>
        
    </form>
</x-layout>
@vite('resources/js/ISOInput.js')
