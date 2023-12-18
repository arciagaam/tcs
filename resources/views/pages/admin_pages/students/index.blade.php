<x-layout>
    <x-page-title>Your Roles</x-page-title>

    <div class="flex flex-col gap-5 bg-white p-5 rounded-lg shadow-sm ">
        <h2 class="text-lg font-medium">Select Role</h2>
        <div class="grid grid-cols-3 gap-3">
            @foreach ($roles as $role)
                @php
                    $image = convertToKebabCase($role->name);
                    $bgColors = [
                        'thesis-adviser' => 'bg-blue-950/50',
                        'technical-editor' => 'bg-primary-800/60',
                        'system-expert' => 'bg-green-950/30',
                    ]
                @endphp

                <div class="relative !bg-no-repeat !bg-contain !bg-center" style='background: url({{asset("images/$image.jpg")}})'>
                    <a href="{{route('admin-roles.students.index', ['role' => $role])}}" class="!bg-no-repeat !bg-contain !bg-center flex items-center justify-center p-2 border rounded-lg min-h-[10rem] {{$bgColors[$image]}} hover:brightness-125 text-white font-bold text-xl transition-all">
                        <h2>{{$role->name}}</h2>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

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
                                    <div class="flex flex-row gap-2">
                                        @if(checkRole(auth()->user(), [2,3,4]))
                                            {{-- <a href="{{route('users.edit', ['user' => $student->id])}}" class="text-primary-800 button button-outline ring-1 ring-primary-800 hover:bg-primary-800 hover:text-white">Edit</a> --}}
                                            <form action="{{route('admin-roles.show', ['admin_role' => $role, 'student' => $student])}}" method="GET">
                                                @csrf
                                                <button class="text-primary-800 button button-outline ring-1 ring-primary-800 hover:bg-primary-800 hover:text-white cursor-pointer">View</button>
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