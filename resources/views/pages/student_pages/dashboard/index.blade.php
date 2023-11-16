<x-layout>
    <x-page-title>Gantt Chart Progress</x-page-title>

    <form action="{{route('home.store')}}" method="POST" class="card flex w-1/2" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <label class="label font-medium text-base text-black/50" for="gantt_chart_image_path">Update Gantt Chart</label>
            <label for="gantt_chart_image_path" class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                <div class="flex gap-2 whitespace-nowrap">
                    <box-icon name='upload'></box-icon>
                    <p>Gantt Chart</p>
                </div>
                <input id="gantt_chart_image_path" name="gantt_chart_image_path" type="file" class="opacity-0 max-h-0 max-w-0">
            </label>

            @error('gantt_chart_image_path')
            <p class="self-end text-xs text-red-400">{{$message}}</p>
        @enderror
        </div>

        <button class="button default h-fit w-fit">Save</button>
    </form>

    <div class="card">
        <h2 class="font-medium text-base text-black/50">Gantt Chart</h2>

        @if (auth()->user()->student->gantt_chart_image_path)
            <img class="w-full h-auto" src="{{asset('storage/'.auth()->user()->student->gantt_chart_image_path)}}" alt="">
        @else
            <h2>No uploaded gantt chart</h2>
        @endif
    </div>

</x-layout>

@vite('resources/js/ISOInput.js')