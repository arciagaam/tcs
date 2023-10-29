<x-layout>
    <x-page-title>
        Teachers    
    </x-page-title>

    <div class="card">
        <h2 class="text-lg font-medium">Add Teacher</h2>

        <form action="{{route('teachers.store')}}" method="POST" class="grid grid-cols-3 gap-3">
            @csrf
            <div class="input-group">
                <label for="first_name" class="label">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" class="input" value="{{old('first_name')}}">
                @error('first_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="middle_name" class="label">Middle Name <span class="ml-1 text-xs text-black/30 text-start">optional</span></label>
                <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" class="input" value="{{old('middle_name')}}">
                @error('middle_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="last_name" class="label">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" class="input" value="{{old('last_name')}}">
                @error('last_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter your email" class="input" value="{{old('email')}}">
                @error('email')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="input">
                @error('password')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="confirm_password" class="label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" class="input">
                @error('confirm_password')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col col-span-3 gap-3 w-fit">
                <h2 class="text-lg font-bold">Select Teacher Roles</h2>

                <div class="flex gap-10">
                    <div class="flex gap-2">
                        <input type="checkbox" id="cb_ta" name="roles[]" value="2">
                        <label for="cb_ta" >Thesis Adviser</label>
                    </div>
                    <div class="flex gap-2">
                        <input type="checkbox" id="cb_te" name="roles[]" value="3">
                        <label for="cb_te" >Thesis Adviser</label>
                    </div>
                    <div class="flex gap-2">
                        <input type="checkbox" id="cb_se" name="roles[]" value="4">
                        <label for="cb_se" >System Expert</label>
                    </div>
                </div>

                @error('roles')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
                
            </div>

            <div class="flex flex-col w-full col-span-3">
                <button class="self-end button default">Add Teacher</button>
            </div>
        </form>
    </div>
    
    <div class="card">
        <h2 class="text-lg font-medium">Teachers List</h2>

        <div class="flex justify-end">
            <x-table.search />
        </div>
        <div class="flex">
            <x-table.main class="w-full table-auto">
                <x-table.head>
                    <x-table.row class="text-left bg-primary-800">
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Email</x-table.header>
                        <x-table.header>Roles</x-table.header>
                        {{-- <x-table.header>Actions</x-table.header> --}}
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @if (count($teachers))
                        @foreach ($teachers as $teacher)
                            <x-table.row class="odd:bg-white even:bg-primary-50">
                                <x-table.data>{{formatName($teacher)}}</x-table.data>
                                <x-table.data>{{$teacher->email}}</x-table.data>
                                <x-table.data>{{displayRoles($teacher->roles)}}</x-table.data>
                                {{-- <x-table.data>
                                    <div class="flex gap-2">
                                        <a href="{{route('users.show', ['user' => $user->id])}}" class="text-primary-800 button button-outline ring-primary-800 hover:bg-primary-800 hover:text-white">View</a>
                                        @if(checkRole(auth()$teacher(), [1]))
                                            <a href="{{route('users.edit', ['user' => $user->id])}}" class="text-primary-800 button button-outline ring-primary-800 hover:bg-primary-800 hover:text-white">Edit</a>
                                            <a href="{{route('users.destroy', ['user' => $user->id])}}" class="text-red-400 button button-outline ring-red-400 hover:bg-red-400 hover:text-white">Delete</a>
                                        @endif
                                    </div>
                                </x-table.data> --}}
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
        {{-- {{$users->links()}} --}}
    </div>
</x-layout>