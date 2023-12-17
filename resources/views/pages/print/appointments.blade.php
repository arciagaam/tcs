<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Appointment</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col items-center p-10 gap-10">

    <div class="flex gap-5 items-center">
        <img src="{{asset('images/logo.png')}}" alt="logo" class="w-[5rem] aspect-square">

        <div class="flex flex-col items-center">
            <p>College of Computer Studies</p>
            <p>Laguna State Polytechnic University</p>
            <p>Sta Cruz Laguna</p>
        </div>
    </div>

    <table class="border w-full">
        <thead>
            <tr>
                <th class="border py-2">Group Code</th>
                <th class="border py-2">Name</th>
                <th class="border py-2">Remarks</th>
                <th class="border py-2">Date</th>
                <th class="border py-2">Purpose / Nature</th>
                <th class="border py-2">Status</th>
            </tr>
        </thead>
        <tbody class="border">

            @if (count($appointmentsList))
                @foreach ($appointmentsList as $appointment)
                    <x-table.row class="odd:bg-white even:bg-primary-50">
                        <x-table.data class="border">{{ $appointment->group_code }}</x-table.data>
                        <x-table.data class="border">{{ $appointment->name ?? 'N/A' }}</x-table.data>
                        <x-table.data class="border">{{ $appointment->remarks ?? 'N/A' }}</x-table.data>
                        <x-table.data class="border">{{ $appointment->start_date->format('Y/m/d H:m') }} -
                            {{ $appointment->end_date->format('Y/m/d H:m') }}</x-table.data>
                        <x-table.data class="border">
                            @if ($appointment->document_path != '')
                                <a href="{{ asset('storage/' . $appointment->document_path) }}"
                                    download="Group {{ $appointment->group_code }} - Appointment {{ $appointment->created_at->format('Y/m/d H:m') }}">{{ explode('/', $appointment->document_path)[1] ?? 'N/A' }}</a>
                            @else
                                N/A
                            @endif
                        </x-table.data>
                        {{-- <x-table.data>{{$appointment->user->student->year}} - {{$appointment->user->student->section}}</x-table.data> --}}
                        <x-table.data>{{ $appointment->status == 2 ? 'Approved' : 'Declined' }}</x-table.data>
                    </x-table.row>
                @endforeach
            @else
                <x-table-no-data />
            @endif

        </tbody>
    </table>

</body>

</html>
