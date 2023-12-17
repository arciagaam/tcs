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
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-[5rem] aspect-square">

        <div class="flex flex-col items-center">
            <p>College of Computer Studies</p>
            <p>Laguna State Polytechnic University</p>
            <p>Sta Cruz Laguna</p>
        </div>
    </div>

    <table class="border w-full">
        <thead>
            <tr>
                <th>Group Code</th>
                <th>Title</th>
                <th>Email</th>
                <th>Remarks</th>
                <th>Purpose</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="border">

            @if (count($reportsList))
                @foreach ($reportsList as $report)
                    <x-table.row class="odd:bg-white even:bg-primary-50">
                        <x-table.data>{{ $report->group_code }}</x-table.data>
                        <x-table.data>{{ $report->title }}</x-table.data>
                        <x-table.data>{{ $report->email }}</x-table.data>
                        <x-table.data>{{ $report->description }}</x-table.data>
                        <x-table.data>
                            @if ($report->document_path != '')
                                <a href="{{ asset('storage/' . $report->document_path) }}"
                                    download="Group {{ $report->group_code }} - Report {{ $report->created_at->format('Y-m-d') }}">{{ explode('/', $report->document_path)[1] ?? 'N/A' }}</a>
                            @else
                                N/A
                            @endif
                        </x-table.data>
                        <x-table.data>{{ $report->created_at->format('Y-m-d H:s') }}</x-table.data>
                        <x-table.data>{{ $report->status == 2 ? 'Approved' : 'Declined' }}</x-table.data>
                    </x-table.row>
                @endforeach
            @else
                <x-table-no-data />
            @endif

        </tbody>
    </table>

</body>

</html>
