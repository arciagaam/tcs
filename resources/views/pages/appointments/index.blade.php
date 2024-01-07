<x-layout>
    <div class="flex justify-between w-full">
        <x-page-title>Appointments</x-page-title>
        @if (checkRole(auth()->user(), [1, 2, 3, 4]))
            <a href="{{ route('appointments.requests.index') }}" class="button default">View Appointment Requests</a>
        @endif
    </div>

    <div class="flex gap-5">

        <div class="flex flex-col gap-5 w-1/4">

            @if (checkRole(auth()->user(), [1, 2, 3, 4]))
                <div class="flex flex-col gap-5 p-5 rounded-lg bg-white shadow-sm h-fit">
                    <h2 class="text-lg font-medium">Add Appointment</h2>

                    <form action="{{ route('appointments.store') }}" method="POST" class="grid grid-cols-1 gap-3">
                        @csrf
                        <div class="input-group">
                            <label for="group_code" class="label">Group Code</label>
                            <input type="text" id="group_code" name="group_code" placeholder="Enter group code"
                                class="input" value="{{ old('group_code') }}">
                            @error('group_code')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="role_id" class="label">Create Appointment As</label>
                            <select name="role_id" id="role_id" class="input">
                                <option value="2">Thesis Adviser</option>
                                <option value="3">Technical Editor</option>
                                <option value="4">System Expert</option>
                            </select>
                            @error('role_id')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="consultation_name" class="label">Consultation Name</label>
                            <input type="text" id="consultation_name" name="consultation_name"
                                placeholder="Enter consultation name" class="input"
                                value="{{ old('consultation_name') }}">
                            @error('consultation_name')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="start_date" class="label">Start Date</label>
                            <input type="datetime-local" id="start_date" name="start_date"
                                placeholder="Enter your last name" class="input" value="{{ old('start_date') }}">
                            @error('start_date')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="end_date" class="label">End Date</label>
                            <input type="datetime-local" id="end_date" name="end_date"
                                placeholder="Enter your last name" class="input" value="{{ old('end_date') }}">
                            @error('end_date')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <button class="self-end w-full button default">Add Appointment</button>
                        </div>
                    </form>
                </div>
            @endif

            @if (checkRole(auth()->user(), [5]))
                <div class="flex flex-col gap-5 p-5 rounded-lg bg-white shadow-sm h-fit">
                    <h2 class="text-lg font-medium">Request Appointment</h2>

                    <form action="{{ route('appointments.store') }}" method="POST" class="grid grid-cols-1 gap-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <label for="group_code" class="label">Group Code</label>
                            <input type="text" id="group_code" name="group_code" placeholder="Enter group code"
                                class="input" value="{{ old('group_code') }}">
                            @error('group_code')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="panel" class="label">Panel</label>
                            <select name="panel" id="panel" class="input">
                                @foreach ($panels as $role => $panel)
                                    @if (!$panel)
                                        @continue
                                    @endif
                                    <option value="{{ $panel->id }}">{{ $role }} -
                                        {{ formatName($panel->user) }}</option>
                                @endforeach
                            </select>

                            @error('group_code')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="name" class="label">Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter consultation name"
                                class="input" value="{{ old('name') }}">
                            @error('name')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="email" class="label">Email</label>
                            <input type="text" id="email" name="email"
                                placeholder="Enter consultation email" class="input" value="{{ old('email') }}">
                            @error('email')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="remarks" class="label">Remarks</label>
                            <input type="text" id="remarks" name="remarks"
                                placeholder="Enter consultation remarks" class="input"
                                value="{{ old('remarks') }}">
                            @error('remarks')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <p class="label">Nature / Purpose</p>

                            <label for="document"
                                class="bg-white flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                                <div class="flex gap-2 whitespace-nowrap">
                                    <box-icon name='upload'></box-icon>
                                    <p>Upload File</p>
                                </div>
                                <input id="document" name="document" type="file"
                                    class="opacity-0 max-h-0 max-w-0">
                            </label>
                            @error('document')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-group">
                            <p class="label">Upload Video</p>

                            <label for="video"
                                class="bg-white flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                                <div class="flex gap-2 whitespace-nowrap">
                                    <box-icon name='upload'></box-icon>
                                    <p>Upload Video</p>
                                </div>
                                <input id="video" name="video" type="file"
                                    class="opacity-0 max-h-0 max-w-0">
                            </label>
                            @error('video')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="start_date" class="label">Start Date</label>
                            <input type="datetime-local" id="start_date" name="start_date"
                                placeholder="Enter your last name" class="input" value="{{ old('start_date') }}">
                            @error('start_date')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="end_date" class="label">End Date</label>
                            <input type="datetime-local" id="end_date" name="end_date"
                                placeholder="Enter your last name" class="input" value="{{ old('end_date') }}">
                            @error('end_date')
                                <p class="self-end text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <button class="async self-end w-full button default">Request Appointment</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

        <div id="calendarEl" class="flex flex-1 w-full bg-white p-5 shadow-sm rounded-lg">
        </div>
    </div>

</x-layout>

@vite('resources/js/calendar.js')
@vite('resources/js/ISOInput.js')
@vite('resources/js/asyncButton.js')
