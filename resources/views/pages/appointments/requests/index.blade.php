<x-layout>
    <x-page-title>Appointment Requests</x-page-title>

    <div class="flex flex-col bg-white rounded-lg shadow-sm gap-5 p-5">
        <h2 class="text-lg font-medium">
            Active Requests
        </h2>
        
        <div class="flex">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Name</x-table.header>
                        {{-- <x-table.header>Email</x-table.header> --}}
                        <x-table.header>Remarks</x-table.header>
                        <x-table.header>Date</x-table.header>
                        <x-table.header>Purpose / Nature</x-table.header>
                        {{-- <x-table.header>Year and Section</x-table.header> --}}
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @if (count($pendingAppointments))
                        @foreach ($pendingAppointments as $appointment)
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{$appointment->group_code}}</x-table.data>
                                <x-table.data>{{$appointment->name}}</x-table.data>
                                <x-table.data>{{$appointment->remarks ?? 'N/A'}}</x-table.data>
                                <x-table.data>{{$appointment->start_date->format('Y/m/d H:m')}} - {{$appointment->end_date->format('Y/m/d H:m')}}</x-table.data>
                                <x-table.data>
                                    @if($appointment->document_path != '')
                                        <a href="{{asset('storage/'.$appointment->document_path)}}" download="Group {{$appointment->group_code}} - Appointment {{$appointment->created_at->format('Y/m/d H:m')}}">{{explode('/',$appointment->document_path)[1] ?? 'N/A'}}</a>
                                    @else
                                        N/A
                                    @endif
                                </x-table.data>
                                {{-- <x-table.data>{{$appointment->user->student->year}} - {{$appointment->user->student->section}}</x-table.data> --}}
                                <x-table.data>
                                    <div class="flex gap-2">
                                        <form action="{{route('appointments.update', ['appointment' => $appointment->id])}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="1" name="verdict">
                                            <button class="button default">Approve</button>
                                        </form>
                                        <a href="{{route('appointments.requests.edit', ['request' => $appointment->id])}}" class="button default">Edit</a>
                                        <form action="{{route('appointments.update', ['appointment' => $appointment->id])}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="0" name="verdict">
                                            <button class="button default">Reject</button>
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
        <div class="flex">
            {{-- {{$users->links()}} --}}
        </div>
    </div>

    <div class="flex flex-col bg-white rounded-lg shadow-sm gap-5 p-5">
        <h2 class="text-lg font-medium">
            Appointment List
        </h2>
        
        <div class="flex">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Group Code</x-table.header>
                        <x-table.header>Name</x-table.header>
                        {{-- <x-table.header>Email</x-table.header> --}}
                        <x-table.header>Remarks</x-table.header>
                        <x-table.header>Date</x-table.header>
                        <x-table.header>Purpose / Nature</x-table.header>
                        {{-- <x-table.header>Year and Section</x-table.header> --}}
                        <x-table.header>Status</x-table.header>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @if(count($appointmentsList))
                        @foreach ($appointmentsList as $appointment)
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{$appointment->group_code}}</x-table.data>
                                <x-table.data>{{$appointment->name ?? 'N/A'}}</x-table.data>
                                <x-table.data>{{$appointment->remarks ?? 'N/A'}}</x-table.data>
                                <x-table.data>{{$appointment->start_date->format('Y/m/d H:m')}} - {{$appointment->end_date->format('Y/m/d H:m')}}</x-table.data>
                                <x-table.data>
                                    @if($appointment->document_path != '')
                                        <a href="{{asset('storage/'.$appointment->document_path)}}" download="Group {{$appointment->group_code}} - Appointment {{$appointment->created_at->format('Y/m/d H:m')}}">{{explode('/',$appointment->document_path)[1] ?? 'N/A'}}</a>
                                    @else
                                        N/A
                                    @endif
                                </x-table.data>
                                {{-- <x-table.data>{{$appointment->user->student->year}} - {{$appointment->user->student->section}}</x-table.data> --}}
                                <x-table.data>{{$appointment->status == 2 ? 'Approved' : 'Declined'}}</x-table.data>
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