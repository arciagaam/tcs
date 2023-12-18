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
</x-layout>