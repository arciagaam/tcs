<x-layout>
    <div class="flex flex-col gap-1">
        <a href="{{route('admin-roles.index')}}" class="underline w-fit">Back to Role Selection</a>
        <x-page-title>Student Submissions as {{ $role->name }} </x-page-title>
    </div>
    
    <div class="flex flex-col bg-white p-5 rounded-lg shadow-sm gap-5">

        <div class="flex justify-end">
            <x-table.search placeholder="Search for Group Code" id="groupCode"/>
        </div>

        <x-table.main class="w-full table-auto">
            <x-table.head>
                <x-table.row class="text-left bg-primary-800">
                    <x-table.header>Group Code</x-table.header>
                    <x-table.header>Name</x-table.header>
                    <x-table.header>Email</x-table.header>
                    <x-table.header>Year and Section</x-table.header>
                    <x-table.header>Actions</x-table.header>
                </x-table.row>
            </x-table.head>

            <x-table.body>
                @if (count($submissions))
                    @foreach ($submissions as $submission)
                        <x-table.row class="odd:bg-white even:bg-primary-50">
                            <x-table.data>{{ $submission->student->group_code }}</x-table.data>
                            <x-table.data>{{ formatName($submission->student->user) }}</x-table.data>
                            <x-table.data>{{ $submission->student->user->email }}</x-table.data>
                            <x-table.data>{{ formatYearSection($submission->student) }}</x-table.data>
                            <x-table.data>
                                <div class="flex gap-2">
                                    <a href="{{ route('submission', ['submission' => $submission]) }}"
                                        class="text-primary-800 button outline ring-primary-800 hover:bg-primary-800 hover:text-white">View
                                        Submission</a>
                                    {{-- @if (checkRole(auth()->user(), [1])) 
                                        <a href="{{route('users.edit', ['user' => $user->id])}}" class="text-primary-800 button button-outline ring-primary-800 hover:bg-primary-800 hover:text-white">Edit</a>
                                        <a href="{{route('users.destroy', ['user' => $user->id])}}" class="text-red-400 button button-outline ring-red-400 hover:bg-red-400 hover:text-white">Delete</a>
                                    @endif --}}
                                </div>
                            </x-table.data>
                        </x-table.row>
                    @endforeach
                @else
                    <x-table-no-data />
                @endif
            </x-table.body>
        </x-table.main>
    </div>

    
    <x-page-title>Students</x-page-title>
    
    <div class="card">
        <div class="flex justify-end">
            <x-table.search placeholder="Search student or group code" id="student"/>
        </div>
        <div class="flex">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Email</x-table.header>
                        <x-table.header>Year and Section</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @if (count($studentList))
                    @foreach ($studentList as $student)
                    {{-- {{dd($student)}} --}}
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{$student->group_code ?? 'N/A'}}</x-table.data>
                                <x-table.data>{{formatName($student->user)}}</x-table.data>
                                <x-table.data>{{$student->user->email}}</x-table.data>
                                <x-table.data>{{formatYearSection($student)}}</x-table.data>
                                <x-table.data>
                                    <div class="flex flex-row gap-2">
                                        @if(checkRole(auth()->user(), [2,3,4]))
                                            <a href="{{route('student.show', ['student' => $student])}}" method="GET">
                                                @csrf
                                                <button class="text-primary-800 button button-outline ring-1 ring-primary-800 hover:bg-primary-800 hover:text-white cursor-pointer">View</button>
                                            </a>
                                        @endif
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
    </div>
    <div class="flex">
        {{$submissions->links()}}
    </div>
    <div class="flex">
        {{$studentList->links()}}
    </div>
</x-layout>
