<x-layout>
    <x-page-title>Admin Dashboard</x-page-title>

    <div class="grid grid-cols-2 w-full gap-5">
        <div class="flex flex-col gap-5 py-10 items-center px-5 bg-white shadow-sm rounded-lg">
            <h2>Students</h2>
            <p>21</p>
        </div>

        <div class="flex flex-col gap-5 py-10 items-center px-5 bg-white shadow-sm rounded-lg">
            <h2>Team Members</h2>
            <p>21</p>
        </div>

        <div class="flex flex-col gap-5 py-10 items-center px-5 bg-white shadow-sm rounded-lg">
            <h2>Appointment</h2>
            <p>10</p>
        </div>

        <div class="flex flex-col gap-5 py-10 items-center px-5 bg-white shadow-sm rounded-lg">
            <h2>Reports</h2>
            <p>10</p>
        </div>
    </div>

    <div class="flex flex-col gap-5 bg-white rounded-lg p-5 shadow-sm">
        <h2 class="text-lg font-medium">Pending Registrations</h2>
        <x-table.main class="w-full table-auto rounded-lg">
            <x-table.head>
                <x-table.row class="text-left bg-primary-800">
                    <x-table.header>Group Code</x-table.header>
                    <x-table.header>Name</x-table.header>
                    <x-table.header>Year and Section</x-table.header>
                    <x-table.header>Role for student</x-table.header>
                    <x-table.header>File</x-table.header>
                    <x-table.header>Actions</x-table.header>
                </x-table.row>
            </x-table.head>

            <x-table.body>
                @if (count($pendingRegistrations))
                    @foreach ($pendingRegistrations as $pendingFile)
                        <x-table.row class="odd:bg-white even:bg-primary-50">
                            <x-table.data>{{$pendingFile->student->group_code ?? 'N/A'}}</x-table.data>
                            <x-table.data>{{$pendingFile->student->user->first_name}} {{$pendingFile->student->user->middle_name ?? ''}} {{$pendingFile->student->user->last_name}}</x-table.data> 
                            <x-table.data>{{formatYearSection($pendingFile->student)}}</x-table.data>
                            <x-table.data>{{$pendingFile->toRoleId->name}}</x-table.data>
                            <x-table.data>{{$pendingFile->path}}</x-table.data>
                            <x-table.data>
                                <div class="flex gap-2">
                                    <form action="{{route('dashboard.update', ['studentFile' => $pendingFile])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="0" name="verdict">
                                        <button class="button default">Reject</button>
                                    </form>

                                    <form action="{{route('dashboard.update', ['studentFile' => $pendingFile])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="1" name="verdict">
                                        <button class="button default">Approve</button>
                                    </form>
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

</x-layout>