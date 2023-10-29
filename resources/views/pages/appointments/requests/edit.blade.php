<x-layout>
    <x-page-title>Edit Appointment Request | Group {{$appointment->group_code}}</x-page-title>
    <form action="{{route('appointments.requests.update', ['request' => $appointment])}}" method="POST" class="card">
        @csrf
        @method('PUT')
        <div class="col-span-2 input-group">
            <label for="start_date" class="label">Start Date</label>
            <input type="datetime-local" id="start_date" name="start_date"  class="input" value="{{$appointment->start_date}}">
            @error('group_code')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="col-span-2 input-group">
            <label for="end_date" class="label">End Date</label>
            <input type="datetime-local" id="end_date" name="end_date"  class="input" value="{{$appointment->end_date}}">
            @error('end_date')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <a href="{{route('appointments.requests.index')}}" class="button default">Cancel</a>
            <button class="button default">Save and Approve</button>
        </div>
    </form>
</x-layout>