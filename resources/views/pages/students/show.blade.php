<x-layout>
    <div class="flex flex-row gap-10">
        <div class="flex flex-col card w-fit">
            <div class="h-28 w-28 rounded-full aspect-square bg-blue-950 self-center"></div>
    
            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Full name</p>
                <p>{{$student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name}}</p>
            </div>
    
            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Email</p>
                <p>{{$student->email}}</p>
            </div>
    
            <hr>
    
            <div class="flex gap-10">
                <div class="flex flex-col">
                    <p class="font-medium text-black/50 text-sm">Year & Section</p>
                    <p>{{$student->year . ' ' . $student->section}}</p>
                </div>
    
                <div class="flex flex-col">
                    <p class="font-medium text-black/50 text-sm">Group Code</p>
                    <p>{{$student->group_code}}</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-5 w-full">
            <x-page-title>Progress of Student</x-page-title>
            <div id="gantt_here" class="w-full h-96"></div>
        </div>
    </div>
    
</x-layout>
<script>
    const userId = {{$student->id}};
</script>
@vite('resources/js/teacherGantt.js')