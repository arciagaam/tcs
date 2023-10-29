<x-layout>
    <x-page-title>
        {{ $submission->group_code }} | {{ $submission->name }}
    </x-page-title>

    <div class="card">
        <h2 class="text-lg font-medium">{{ ucfirst($submission->file_type) }} Submission</h2>

        <div class="flex flex-col">
            <h3>Submission Name</h3>
            <p>{{ $submission->name }}</p>
        </div>
        <div class="flex flex-col">
            <h3>Attachment:</h3>
            <div class="flex gap-2">
                <p>{{ $submission->file_name }}</p>
                <a href="{{ asset('storage/' . $submission->path) }}"
                    download="{{ $submission->group_code }}-{{ $submission->name }}" class="button default p-0 px-3 text-sm">Download
                    File</a>
            </div>
        </div>
        @if (checkRole(auth()->user(), [1, 2, 3, 4]))

            <hr>
            @if (count($submission->check))
                <h2 class="text-lg font-medium">Submission Checked!</h2>
                <div class="input-group">
                    <label for="group_code">Remarks</label>
                    <textarea disabled readonly class="resize-none input rounded-lg" name="remarks" id="remarks" cols="30"
                        rows="10">{{ $submission->check[0]->remarks ?? 'No remarks.' }}</textarea>
                    @error('group_code')
                        <p class="self-end text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <h3>Attachment:</h3>
                    <div class="flex gap-2">
                        <p>{{ $submission->check[0]->file_name }}</p>
                        <a href="{{ asset('storage/' . $submission->check[0]->file_path) }}" download
                            class="button default p-0 px-3 text-sm">Download File</a>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ route('submission.check', ['submission' => $submission]) }}"
                    class="flex flex-col w-fit gap-5" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium">Check Submission</h2>

                    <label for="check_file"
                        class="flex items-center justify-center px-4 py-2 text-base border rounded-full cursor-pointer h-fit">
                        <div class="flex gap-2 whitespace-nowrap">
                            <box-icon name='upload'></box-icon>
                            <p>Upload File</p>
                        </div>
                        <input id="check_file" name="check_file" type="file" class="opacity-0 max-h-0 max-w-0">
                    </label>
                    <div class="input-group">
                        <label for="group_code" class="label">Remarks</label>
                        <textarea class="resize-none input rounded-lg" name="remarks" id="remarks" cols="30" rows="10"></textarea>
                        @error('group_code')
                            <p class="self-end text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="button default">Check Submission</button>
                </form>
            @endif
        @endif
    </div>

</x-layout>

@vite('resources/js/ISOInput.js')
