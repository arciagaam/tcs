<x-layout>
    <x-page-title>Your Roles</x-page-title>

    <div class="flex flex-col gap-5 bg-white p-5 rounded-lg shadow-sm">
        <h2 class="text-lg font-medium">Select Role</h2>
        <div class="grid grid-cols-3 gap-3">
            @foreach ($roles as $role)
        
                <a href="{{route('admin-roles.students.index', ['role' => $role])}}" class="flex items-center justify-center p-2 border rounded-lg min-h-[10rem] hover:bg-primary-700 bg-white hover:text-white transition-[background]">
                    <h2>{{$role->name}}</h2>
                </a>
            @endforeach
        </div>
    </div>

</x-layout>