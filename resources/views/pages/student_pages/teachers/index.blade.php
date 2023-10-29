<x-layout>
    <div class="flex w-full justify-between items-start">
        <x-page-title>Panel Members</x-page-title>
        @if (!$ta || !$te || !$se)
            <a href="{{route('panel-members.create')}}">
                <button class="button default">Add Panel</button>
            </a>
        @endif
    </div>

    <div class="grid grid-cols-3 gap-3 card">

        @if($ta)
            <a href="{{route('panel-members.submissions.index', ['role' => 2])}}" class="flex flex-col items-center justify-center p-2 min-h-[10rem] transition-all border rounded-lg hover:text-white hover:bg-primary-800">
                <h2>Thesis Adviser</h2>
                <p>{{formatName($ta)}}</p>
            </a>
        @endif

        @if ($te)
            <a href="{{route('panel-members.submissions.index', ['role' => 3])}}" class="flex flex-col items-center justify-center p-2 min-h-[10rem] transition-all border rounded-lg hover:text-white hover:bg-primary-800">
                <h2>Technical Editor</h2>
                <p>{{formatName($te)}}</p>
            </a>
        @endif

        @if ($se)
            <a href="{{route('panel-members.submissions.index', ['role' => 4])}}" class="flex flex-col items-center justify-center p-2 min-h-[10rem] transition-all border rounded-lg hover:text-white hover:bg-primary-800">
                <h2>System Expert</h2>
                <p>{{formatName($se)}}</p>
            </a>
        @endif

    </div>

</x-layout>