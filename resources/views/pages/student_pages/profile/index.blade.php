<x-layout>
    <x-page-title>User Profile</x-page-title>

    <div class="flex flex-col card w-fit">

        <div class="flex gap-10 justify-between">
            <div class="h-28 w-28 rounded-full aspect-square bg-blue-950 overflow-clip self-center">
                @isset(auth()->user()->student->profile_picture)
                    <img class="object-cover h-full" src="{{asset('storage/' . auth()->user()->student->profile_picture)}}" alt="profile picture">
                @endisset
            </div>
            <a href="{{route('profile.edit', ['profile' => auth()->user()->student->id])}}" class="button default h-fit w-fit">Edit Profile</a>
        </div>

        <div class="flex flex-col">
            <p class="font-medium text-black/50 text-sm">Full name</p>
            <p>{{ formatName(auth()->user()) }}</p>
        </div>

        <div class="flex flex-col">
            <p class="font-medium text-black/50 text-sm">Email</p>
            <p>{{ auth()->user()->email }}</p>
        </div>

        <hr>

        <div class="flex gap-10">
            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Year & Section</p>
                <p>{{ formatYearSection(auth()->user()->student) }}</p>
            </div>

            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Group Code</p>
                <p>{{ auth()->user()->student->group_code }}</p>
            </div>

            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Thesis Title</p>
                <p>{{ auth()->user()->student->thesis_title }}</p>
            </div>
        </div>


    </div>
</x-layout>
