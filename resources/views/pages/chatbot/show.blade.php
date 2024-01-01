<x-layout>
    <x-page-title>Chatbot</x-page-title>

    @if(checkRole(auth()->user(), [1]))
        <div class="flex flex-col w-full gap-5 lg:flex-row">
            <div class="card min-w-[350px] max-h-[70vh] overflow-y-scroll">
                <h2 class="text-lg font-medium">
                    Conversations
                    @foreach ($inbox as $conversations)
                    {{-- {{dd($conversation->first_name)}} --}}
                        <a href="{{route('chatbot.show', ['chatbot' => $conversations->id]) }}" class="card items gap-2 flex-row items-center my-2 shadow-sm border-gray-300 hover:bg-black/5">
                            <div class="flex items-center justify-center bg-primary-800 self-start rounded-full min-w-[40px] min-h-[40px]"></div>
                            <div class="flex flex-col">
                                <p>{{$conversations->first_name.' '.$conversations->middle_name.' '.$conversations->last_name}}</p> 
                                <p class="text-sm overflow-x-hidden whitespace-nowrap">Recent Message</p> 
                            </div>
                        </a>
                    @endforeach      
                </h2>
            </div>
            <div class="card w-full">
                <div class="flex flex-col flex-1 ring-1 ring-black/20 rounded-lg overflow-clip">
                    <div class="flex">
                        @if ($conversation)
                            <div id="messages" class="flex flex-col w-full gap-2 mt-auto p-5 overflow-y-auto min-h-[60vh] max-h-[60vh]">
                                @foreach ($conversation->messages as $message)
                                    <div class="flex {{($message->sender_user_id != 1 && $message->sender_user_id) ? 'justify-start text-left' : 'justify-end text-right'}}">
                                        @if($message->sender_user_id != 1 && $message->sender_user_id)
                                            <div class="flex items-center justify-center bg-primary-800 self-end rounded-full min-w-[40px] min-h-[40px]">
                                                {{-- <img src="" alt="a"> --}}
                                            </div>
                                        @endif
                                            <p class="py-6 ml-5 w-fit rounded-xl even:bg-slate-100 {{($message->sender_user_id != 1 && $message->sender_user_id) ? 'px-4' : ''}} ">{{$message->message}}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div id="noConversation" class="flex flex-col flex-1 w-full min-h-[60vh] max-h-[60vh] items-center justify-center">
                                <p class="text-lg text-black/50">Send a message to start using the chat bot.</p>
                            </div>
                        @endif
                    </div>
                    <div class="flex bg-white">
                        <input id="inputField" type="text" placeholder="Respond here" class="p-2 input rounded-none">
                        <button id="sendBtn" data-sendUrl="{{route('chatbot.send')}}" data-conversationId="{{$conversation->id ?? null}}" class="px-5">Send</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @vite('resources/js/chatBot.js')

</x-layout>