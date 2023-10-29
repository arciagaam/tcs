<x-layout>
    <h2 class="text-2xl font-bold">Submissions for {{$role->name}}</h2>

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
                        <x-table.header></x-table.header>
                    </x-table.row>
                </x-table.head>
    
                <x-table.body>
                    @foreach ($fileSubmissions as $file)
                        <x-table.row class="odd:bg-white even:bg-primary-50">
                            <x-table.data>{{$file->name}}</x-table.data>
                            <x-table.data>{{$file->file_name}}</x-table.data>
                            <x-table.data>{{$file->created_at->format('Y-m-d h:m')}}</x-table.data>
                            <x-table.data>{{$file->group_code}}</x-table.data>
                            <x-table.data></x-table.data>
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
                        <x-table.header></x-table.header>
                    </x-table.row>
                </x-table.head>
    
                <x-table.body>
                    @foreach ($videoSubmissions as $file)
                    <x-table.row class="odd:bg-white even:bg-primary-50">
                        <x-table.data>{{$file->name}}</x-table.data>
                        <x-table.data>{{$file->file_name}}</x-table.data>
                        <x-table.data>{{$file->created_at->format('Y-m-d h:m')}}</x-table.data>
                        <x-table.data>{{$file->group_code}}</x-table.data>
                        <x-table.data></x-table.data>
                    </x-table.row>    
                @endforeach
                </x-table.body>
            </x-table.main>
        </div>
    </div>
</x-layout>