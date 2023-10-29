<x-layout>
    <x-page-title>Chatbot</x-page-title>

    <form action="#" class="card">
        <h2 class="text-lg font-medium">
            Auto Responder
        </h2>

        <div class="input-group gap-2">
            <div class="flex items-center">
                <box-icon name='mail-send' ></box-icon>
                <label for="waiting" class="label">Welcome Message</label>
            </div>
            <input type="text" id="welcome" name="welcome" placeholder="Enter welcome message" class="input" value="{{old('welcome')}}">
            @error('welcome')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="input-group gap-2">
            <div class="flex items-center">
                <box-icon name='hourglass' type='solid' ></box-icon>
                <label for="waiting" class="label">Waiting Message</label>
            </div>
            <input type="text" id="waiting" name="waiting" placeholder="Enter waiting message" class="input" value="{{old('waiting')}}">
            @error('waiting')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="input-group gap-2">
            <div class="flex items-center">
                <box-icon name='x-circle' type='solid' ></box-icon>
                <label for="waiting" class="label">Cancel Message</label>
            </div>
            <input type="text" id="cancel" name="cancel" placeholder="Enter cancel message" class="input" value="{{old('cancel')}}">
            @error('cancel')
                <p class="self-end text-xs text-red-400">{{$message}}</p>
            @enderror
        </div>

        <button class="button default">Save</button>
    </form>

    <div class="card">
        <h2 class="text-lg font-medium">
            Conversations
        </h2>
    </div>
</x-layout>