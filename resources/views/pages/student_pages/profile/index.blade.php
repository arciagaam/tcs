<x-layout>
    <x-page-title>User Profile</x-page-title>

    <div class="flex flex-col">
        <div class="h-28 w-28 rounded-full aspect-square bg-blue-950 "></div>

        <p>{{formatName(auth()->user())}}</p>
        <p>{{formatYearSection(auth()->user()->student)}}</p>
    </div>
</x-layout>