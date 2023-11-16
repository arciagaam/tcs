<x-layout>
    <x-page-title>Chatbot</x-page-title>

    @if(checkRole(auth()->user(), [1]))
        <form action="{{route('chatbot.store')}}" method="POST" class="card">
            @csrf
            <h2 class="text-lg font-medium">
                Auto Responder
            </h2>

            <div class="input-group gap-2">
                <div class="flex items-center">
                    <box-icon name='mail-send' ></box-icon>
                    <label for="welcome" class="label">Welcome Message</label>
                </div>
                <input type="text" id="welcome" name="welcome" placeholder="Enter welcome message" class="input" value="{{$settings['welcome']->value ?? ''}}">
                @error('welcome')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group gap-2">
                <div class="flex items-center">
                    <box-icon name='hourglass' type='solid' ></box-icon>
                    <label for="waiting" class="label">Waiting Message</label>
                </div>
                <input type="text" id="waiting" name="waiting" placeholder="Enter waiting message" class="input" value="{{$settings['waiting']->value ?? ''}}">
                @error('waiting')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <div class="input-group gap-2">
                <div class="flex items-center">
                    <box-icon name='x-circle' type='solid' ></box-icon>
                    <label for="cancel" class="label">Cancel Message</label>
                </div>
                <input type="text" id="cancel" name="cancel" placeholder="Enter cancel message" class="input" value="{{$settings['cancel']->value ?? ''}}">
                @error('cancel')
                    <p class="self-end text-xs text-red-400">{{$message}}</p>
                @enderror
            </div>

            <button class="button default">Save</button>
        </form>

        {{-- <div class="card">
            <h2 class="text-lg font-medium">
                Conversations
            </h2>
        </div> --}}
    @endif

    @if(checkRole(auth()->user(), [5]))

        <div class="card">
            <div class="flex flex-col flex-1 ring-1 ring-black/20 rounded-lg overflow-clip">
                <div class="flex">
                    @if ($conversation)
                        <div id="messages" class="flex flex-col w-full mt-auto overflow-y-auto min-h-[60vh] max-h-[60vh]">
                            @foreach ($conversation->messages as $message)
                                <p class="py-6 px-4 w-full even:bg-slate-100 {{$message->sender_user_id ? 'text-right' : 'text-left'}}">{{$message->message}}</p>
                            @endforeach
                        </div>
                    @else
                        <div id="noConversation" class="flex flex-col flex-1 w-full min-h-[60vh] max-h-[60vh] items-center justify-center">
                            <p class="text-lg text-black/50">Send a message to start using the chat bot.</p>
                        </div>
                    @endif
                </div>
                <div class="flex bg-white">
                    <input id="inputField" type="text" placeholder="Ask something" class="p-2 input rounded-none">
                    <button id="sendBtn" data-sendUrl="{{route('chatbot.send')}}" data-conversationId="{{$conversation->id ?? null}}" class="px-5">Send</button>
                </div>
            </div>
        </div>
    @endif

    @vite('resources/js/chatBot.js')

</x-layout>