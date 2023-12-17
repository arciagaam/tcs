<x-layout>
    <div class="card">
        <h2 class="text-lg font-medium">Edit Teacher</h2>

        <form action="{{route('teachers.update', ['teacher' => $teacher->id])}}" method="POST" class="grid grid-cols-3 gap-3">
            @method('PUT')
            @csrf
            <div class="input-group">
                <label for="first_name" class="label">First Name</label>
                <input value="{{$teacher->first_name}}" type="text" id="first_name" name="first_name" placeholder="Enter your first name" class="input" value="{{old('first_name')}}">
                @error('first_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="middle_name" class="label">Middle Name <span class="ml-1 text-xs text-black/30 text-start">optional</span></label>
                <input value="{{$teacher->middle_name}}" type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" class="input" value="{{old('middle_name')}}">
                @error('middle_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="last_name" class="label">Last Name</label>
                <input value="{{$teacher->last_name}}" type="text" id="last_name" name="last_name" placeholder="Enter your last name" class="input" value="{{old('last_name')}}">
                @error('last_name')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input value="{{$teacher->email}}" type="text" id="email" name="email" placeholder="Enter your email" class="input" value="{{old('email')}}">
                @error('email')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            @php
                $teacherRoles = $teacher->roles->map(fn($val) => $val->id)
            @endphp

            <div class="flex flex-col col-span-3 gap-3 w-fit">
                <h2 class="text-lg font-bold">Select Teacher Roles</h2>

                <div class="flex gap-10">
                    <div class="flex gap-2">
                        <input checked={{$teacherRoles->contains(2)}} type="checkbox" id="cb_ta" name="roles[]" value="2">
                        <label for="cb_ta" >Thesis Adviser</label>
                    </div>
                    <div class="flex gap-2">
                        <input checked={{$teacherRoles->contains(3)}} type="checkbox" id="cb_te" name="roles[]" value="3">
                        <label for="cb_te" >Technical Editor</label>
                    </div>
                    
                    <div class="flex gap-2">
                        <input checked={{$teacherRoles->contains(4)}} type="checkbox" id="cb_se" name="roles[]" value="4">
                        <label for="cb_se" >System Expert</label>
                    </div>
                </div>

                @error('roles')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
                
            </div>

            <div class="flex flex-col w-full col-span-3">
                <button class="self-end button default">Edit Teacher</button>
            </div>
        </form>
    </div>
</x-layout>