<x-layout>
    <x-page-title>Gantt Chart Progress</x-page-title>

    <div id="gantt_here" class="w-full h-96"></div>
</x-layout>
<script>
    let userId = {{ auth()->user()->id }}
    
</script>

@vite('resources/js/ISOInput.js')
@vite('resources/js/gantt.js')