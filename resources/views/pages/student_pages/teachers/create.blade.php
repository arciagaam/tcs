<x-layout>
    <x-page-title>Add Panel</x-page-title>

    <form method="POST" action="{{route('panel-members.store')}}" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @if(!array_key_exists(2, $check))
            <div class="flex flex-col">
                <div class="flex items-end gap-3">
                    <div class="w-full input-group">
                        <label class="label" for="ta_user_id">Thesis Adviser</label>
                        <select name="ta_user_id" id="ta_user_id" class="input">
                            <option value="">Select Thesis Adviser</option>
                            @foreach ($taTeachers as $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name ?? ''}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <label for="ta_iso" class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                        <div class="flex gap-2 whitespace-nowrap">
                            <box-icon name='upload'></box-icon>
                            <p>Upload ISO Form</p>
                        </div>
                        <input id="ta_iso" name="ta_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                    </label>
                
                </div>
                @error('ta_user_id')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
                @error('ta_iso')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
        @endif

        @if(!array_key_exists(3, $check))
            <div class="flex flex-col">
                <div class="flex items-end gap-3">
                    <div class="w-full input-group">
                        <label class="label" for="te_user_id">Technical Editor</label>
                        <select name="te_user_id" id="te_user_id" class="input">
                            <option value="">Select Technical Editor</option>
                            @foreach ($teTeachers as $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name ?? ''}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <label for="te_iso" class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                        <div class="flex gap-2 whitespace-nowrap">
                            <box-icon name='upload'></box-icon>
                            <p>Upload ISO Form</p>
                        </div>
                        <input id="te_iso" name="te_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                    </label>
                </div>

                @error('te_user_id')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
                @error('te_iso')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
        @endif

        @if(!array_key_exists(4, $check))
            <div class="flex flex-col">
                <div class="flex items-end gap-3">
                    <div class="w-full input-group">
                        <label class="label" for="se_user_id">System Expert</label>
                        <select name="se_user_id" id="se_user_id" class="input">
                            <option value="">Select System Expert</option>
                            @foreach ($seTeachers as $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name ?? ''}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <label for="se_iso" class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                        <div class="flex gap-2 whitespace-nowrap">
                            <box-icon name='upload'></box-icon>
                            <p>Upload ISO Form</p>
                        </div>
                        <input id="se_iso" name="se_iso" type="file" class="opacity-0 max-h-0 max-w-0">
                    </label>
                </div>

                @error('se_user_id')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
                @error('se_iso')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>
        @endif

        <button class="button default">Add Panel/s</button>

    </form>
</x-layout>