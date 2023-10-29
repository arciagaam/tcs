<x-layout>
    <x-page-title>Tracking</x-page-title>

    <div class="card">
        <h2 class="text-lg font-medium">
            Tracker
        </h2>
        
        <div class="flex">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>File Name</x-table.header>
                        <x-table.header>Date</x-table.header>
                        <x-table.header>Tracking Number</x-table.header>
                        <x-table.header></x-table.header>
                    </x-table.row>
                </x-table.head>
        
                <x-table.body>
                    @if (count($trackings))
                        @foreach ($trackings as $tracking)
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{$tracking->group_code}}</x-table.data>
                                <x-table.data>{{$tracking->name}}</x-table.data>
                                <x-table.data>
                                    @if($tracking->file_path != '')
                                        <a href="{{asset('storage/'.$tracking->file_path)}}" download="{{$tracking->group_code}}-{{$tracking->number}}">{{$tracking->file_name ?? 'N/A'}}</a>
                                    @else
                                    N/A
                                    @endif
                                </x-table.data>
                                <x-table.data>{{$tracking->created_at->format('Y-m-d H:s')}}</x-table.data>
                                <x-table.data>{{$tracking->number}}</x-table.data>
                                <x-table.data>
                                    <div class="flex gap-2">
                                        <a href="{{route('submission', ['submission' => $tracking->student_submission_id])}}" class="button default">View Submission</a>
                                    </div>
                                </x-table.data>
                            </x-table.row>
                        @endforeach
                    @else
                        <x-table-no-data/>
                    @endif
                </x-table.body>
            </x-table.main>
        </div>

        <div class="flex">
            {{-- {{$users->links()}} --}}
        </div>
    </div>
</x-layout>