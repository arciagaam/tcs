<x-layout>
    <div class="flex flex-col gap-1">
        <a href="{{route('panel-members.index')}}" class="underline w-fit">Back to Panel Members</a>
        <x-page-title>Submissions for {{$role->name}}</x-page-title>
    </div>

    <div class="flex flex-col gap-3">
        <a href="{{route('panel-members.submissions.create', ['role' => $role, 'type' => 'file'])}}" class="self-end button default">Submit File</a>


        <div class="flex flex-col">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Class</x-table.header>
                        <x-table.header>Date</x-table.header>
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                </x-table.head>
    
                <x-table.body>
                    @foreach ($fileSubmissions as $file)
                        <x-table.row class="odd:bg-white even:bg-primary-50">
                            <x-table.data>{{$file->name}}</x-table.data>
                            <x-table.data>{{$file->file_name}}</x-table.data>
                            <x-table.data>{{$file->created_at->format('Y-m-d h:m')}}</x-table.data>
                            <x-table.data>{{$file->group_code}}</x-table.data>
                            <x-table.data>
                                <div class="flex gap-2">
                                    <a href="{{ route('submission', ['submission' => $file]) }}" class="text-primary-800 button outline ring-primary-800 hover:bg-primary-800 hover:text-white">
                                        View Submission
                                    </a>
                                </div>
                            </x-table.data>
                        </x-table.row>    
                    @endforeach
                </x-table.body>
            </x-table.main>
        </div>
    </div>

    <div class="flex flex-col gap-3">
        <a href="{{route('panel-members.submissions.create', ['role' => $role, 'type' => 'video'])}}" class="self-end button default">Upload Video</a>

        <div class="flex flex-col">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Class</x-table.header>
                        <x-table.header>Date</x-table.header>
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                </x-table.head>
    
                <x-table.body>
                    @foreach ($videoSubmissions as $file)
                    <x-table.row class="odd:bg-white even:bg-primary-50">
                        <x-table.data>{{$file->name}}</x-table.data>
                        <x-table.data>{{$file->file_name}}</x-table.data>
                        <x-table.data>{{$file->created_at->format('Y-m-d h:m')}}</x-table.data>
                        <x-table.data>{{$file->group_code}}</x-table.data>
                        <x-table.data>
                            <div class="flex gap-2">
                                <a href="{{ route('submission', ['submission' => $file]) }}" class="text-primary-800 button outline ring-primary-800 hover:bg-primary-800 hover:text-white">
                                    View Submission
                                </a>
                            </div>
                        </x-table.data>
                    </x-table.row>    
                @endforeach
                </x-table.body>
            </x-table.main>
        </div>
    </div>
</x-layout>