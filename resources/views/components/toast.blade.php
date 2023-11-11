@php
    
    $toastData = session('toastData');
    $status = $toastData['status'] ?? null;
    $message = $toastData['message'] ?? null;

@endphp

@if(session()->has('toastData'))
    <div class="animate-toast fixed top-[6.25rem] right-5 flex z-[99] bg-white w-[15rem] px-5 py-5 rounded-lg shadow-lg border border-l-8 {{$status == 'success'  ? 'border-green-400' : 'border-red-400'}}">
        {{$message ?? null}}
    </div>
@endif