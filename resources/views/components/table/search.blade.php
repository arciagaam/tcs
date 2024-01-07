@props([
    'id' => '',
    'placeholder' => 'Search'
])

<form class="flex gap-1 p-1 rounded-lg ring-1 ring-black/20 bg-white w-1/4">
    <input name="{{$id}}" type="text" class="px-2 text-sm focus-visible:outline-none w-full" placeholder="{{$placeholder}}" value="{{request()->$id}}">
    <button type="submit" class="flex items-center justify-center w-fit h-fit">
        <box-icon name='search' size="sm"></box-icon>
    </button>
</form>