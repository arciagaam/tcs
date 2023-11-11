<x-layout>
    <x-page-title>Reports</x-page-title>
    
    @if (checkRole(auth()->user(), [5]))
    <div class="card">
        <h2 class="text-lg font-medium">Submit Report</h2>

        <form action="{{route('reports.store')}}" method="POST" class="grid grid-cols-2 gap-5 w-full" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <label for="group_code" class="label">Group Code</label>
                <input type="text" id="group_code" name="group_code" placeholder="Enter Group Code" class="input">
                @error('group_code')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="panel" class="label">Panel</label>
                <select name="panel" id="panel" class="input">
                    @foreach ($panels as $role => $panel)
                        @if (!$panel)
                            @continue
                        @endif
                        <option value="{{$panel->id}}">{{$role}} - {{formatName($panel->user)}}</option>
                    @endforeach
                </select>
               
                @error('panel')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="date" class="label">Date</label>
                <input type="date" id="date" name="date" placeholder="Enter Date of Report" class="input">
                @error('email')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="name" class="label">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter name" class="input">
                @error('name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter email" class="input">
                @error('email')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="title" class="label">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter Thesis Title" class="input">
                @error('title')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="description" class="label">Description</label>
                <input type="text" id="description" name="description" placeholder="Enter Description" class="input">
                @error('description')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group col-span-2">
                <p class="label">Upload</p>
    
                <label for="document" class="bg-white flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit hover:bg-primary-700 hover:fill-white hover:text-white transition-[background]">
                    <div class="flex gap-2 whitespace-nowrap">
                        <box-icon name='upload'></box-icon>
                        <p>Upload File</p>
                    </div>
                    <input id="document" name="document" type="file" class="opacity-0 max-h-0 max-w-0">
                </label>
                @error('document')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            <button class="mt-5 ml-auto button default col-span-2">Submit Report</button>
        </form>
    </div>
        
    @endif

    @if (checkRole(auth()->user(), [1,2,3,4]))
        <div class="card">
            <h2 class="text-lg font-medium">
                Pending Reports
            </h2>
            
            <div class="flex">
                <x-table.main class="w-full table-auto">
                    <x-table.head>
                        <x-table.row class="text-left bg-primary-800">
                            <x-table.header>Group Code</x-table.header>
                            <x-table.header>Title</x-table.header>
                            <x-table.header>Email</x-table.header>
                            <x-table.header>Remarks</x-table.header>
                            <x-table.header>Purpose</x-table.header>
                            <x-table.header>Date</x-table.header>
                            <x-table.header></x-table.header>
                        </x-table.row>
                    </x-table.head>
            
                    <x-table.body>
                        @if (count($pendingReports))
                            @foreach ($pendingReports as $report)
                                <x-table.row class="odd:bg-white even:bg-primary-50">
                                    <x-table.data>{{$report->group_code}}</x-table.data>
                                    <x-table.data>{{$report->title}}</x-table.data>
                                    <x-table.data>{{$report->email}}</x-table.data>
                                    <x-table.data>{{$report->description}}</x-table.data>
                                    <x-table.data>
                                        @if($report->document_path != '')
                                            <a href="{{asset('storage/'.$report->document_path)}}" download="Group {{$report->group_code}} - Report {{$report->created_at->format('Y-m-d')}}">{{explode('/',$report->document_path)[1] ?? 'N/A'}}</a>
                                        @else
                                            N/A
                                        @endif
                                    </x-table.data>
                                    <x-table.data>{{$report->created_at->format('Y-m-d H:s')}}</x-table.data>
                                    <x-table.data>
                                        <div class="flex gap-2">
                                            <form action="{{route('reports.update', ['report' => $report->id])}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="1" name="verdict">
                                                <button class="button default">Approve</button>
                                            </form>
                                            <form action="{{route('reports.update', ['report' => $report->id])}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="0" name="verdict">
                                                <button class="button default">Decline</button>
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
                {{$pendingReports->links()}}
            </div>
        </div>

        <div class="card">
            <h2 class="text-lg font-medium">
                Reports List
            </h2>
            
            <div class="flex">
                <x-table.main class="w-full table-auto">
                    <x-table.head>
                        <x-table.row class="text-left bg-primary-800">
                            <x-table.header>Group Code</x-table.header>
                            <x-table.header>Title</x-table.header>
                            <x-table.header>Email</x-table.header>
                            <x-table.header>Remarks</x-table.header>
                            <x-table.header>Purpose</x-table.header>
                            <x-table.header>Date</x-table.header>
                            <x-table.header>Status</x-table.header>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        @if (count($reportsList))
                            @foreach ($reportsList as $report)
                                <x-table.row class="odd:bg-white even:bg-primary-50">
                                    <x-table.data>{{$report->group_code}}</x-table.data>
                                    <x-table.data>{{$report->title}}</x-table.data>
                                    <x-table.data>{{$report->email}}</x-table.data>
                                    <x-table.data>{{$report->description}}</x-table.data>
                                    <x-table.data>
                                        @if($report->document_path != '')
                                            <a href="{{asset('storage/'.$report->document_path)}}" download="Group {{$report->group_code}} - Report {{$report->created_at->format('Y-m-d')}}">{{explode('/',$report->document_path)[1] ?? 'N/A'}}</a>
                                        @else
                                            N/A
                                        @endif
                                    </x-table.data>
                                    <x-table.data>{{$report->created_at->format('Y-m-d H:s')}}</x-table.data>
                                    <x-table.data>{{$report->status == 2 ? 'Approved' : 'Declined'}}</x-table.data>
                                </x-table.row>
                            @endforeach
                        @else
                            <x-table-no-data/>
                        @endif
                    </x-table.body>
                </x-table.main>
            </div>

            <div class="flex">
                {{$reportsList->links()}}
            </div>
        </div>
    @endif
</x-layout>
@vite('resources/js/ISOInput.js')
