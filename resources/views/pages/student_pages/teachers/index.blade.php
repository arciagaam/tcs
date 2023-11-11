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
            <div class="relative !bg-no-repeat !bg-contain !bg-center" style='background: url({{asset("images/thesis-adviser.jpg")}})'>
                <a href="{{route('panel-members.submissions.index', ['role' => 2])}}" class="!bg-no-repeat !bg-contain !bg-center flex items-center justify-center p-2 border rounded-lg min-h-[10rem] bg-blue-950/50 hover:brightness-125 text-white font-bold text-xl transition-all">
                    <h2>Thesis Adviser</h2>
                </a>

                <p class="absolute bottom-2 left-5 text-white font-medium text-sm">{{formatName($ta)}}</p>
            </div>

        @endif

        @if ($te)
            <div class="relative !bg-no-repeat !bg-contain !bg-center" style='background: url({{asset("images/technical-editor.jpg")}})'>
                <a href="{{route('panel-members.submissions.index', ['role' => 3])}}" class="!bg-no-repeat !bg-contain !bg-center flex items-center justify-center p-2 border rounded-lg min-h-[10rem] bg-primary-800/60 hover:brightness-125 text-white font-bold text-xl transition-all">
                    <h2>Technical Editor</h2>
                </a>

                <p class="absolute bottom-2 left-5 text-white font-medium text-sm">{{formatName($te)}}</p>
            </div>
        @endif

        @if ($se)
            <div class="relative !bg-no-repeat !bg-contain !bg-center" style='background: url({{asset("images/system-expert.jpg")}})'>
                <a href="{{route('panel-members.submissions.index', ['role' => 4])}}" class="!bg-no-repeat !bg-contain !bg-center flex items-center justify-center p-2 border rounded-lg min-h-[10rem] bg-green-950/30 hover:brightness-125 text-white font-bold text-xl transition-all">
                    <h2>System Expert</h2>
                </a>

                <p class="absolute bottom-2 left-5 text-white font-medium text-sm">{{formatName($se)}}</p>
            </div>
        @endif

    </div>

</x-layout>