<x-layout>
    <x-page-title>Students</x-page-title>
    
    <div class="card">
        <div class="flex justify-end">
            {{-- <x-table.search /> --}}
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
                    @if (count($students))
                        @foreach ($students as $student)
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{$student->group_code ?? 'N/A'}}</x-table.data>
                                <x-table.data>{{formatName($student->user)}}</x-table.data>
                                <x-table.data>{{$student->user->email}}</x-table.data>
                                <x-table.data>{{formatYearSection($student)}}</x-table.data>
                                <x-table.data>
                                    <div class="flex gap-2">
                                        @if(checkRole(auth()->user(), [1]))
                                            {{-- <a href="{{route('users.edit', ['user' => $student->id])}}" class="text-primary-800 button button-outline ring-1 ring-primary-800 hover:bg-primary-800 hover:text-white">Edit</a> --}}
                                            <form action="{{route('students.destroy', ['student' => $student])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 button button-outline ring-1 ring-red-500 hover:bg-red-500 hover:text-white cursor-pointer">Delete</button>
                                            </form>
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
        {{$students->links()}}
    </div>
</x-layout>