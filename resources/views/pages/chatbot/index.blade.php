<x-layout>
    <x-page-title>Chatbot</x-page-title>

    @if(checkRole(auth()->user(), [1]))
        <div class="flex flex-col w-full gap-5 lg:flex-row">
            <div class="card min-w-[350px] max-h-[70vh] overflow-y-scroll">
                <h2 class="text-lg font-medium">
                    Conversations
                    @if ($inbox)
                        @foreach ($inbox as $conversations)
                        {{-- {{dd($conversation->first_name)}} --}}
                            <a href="{{route('chatbot.show', ['chatbot' => $conversations->id])}}" class="card items gap-2 flex-row items-center my-2 shadow-sm border-gray-300 hover:bg-black/5">
                                <div class="flex items-center justify-center bg-primary-800 self-start rounded-full min-w-[40px] min-h-[40px]"></div>
                                <div class="flex flex-col">
                                    <p>{{$conversations->first_name.' '.$conversations->middle_name.' '.$conversations->last_name}}</p> 
                                    <p class="text-sm overflow-x-hidden whitespace-nowrap">Recent Message</p> 
                                </div>
                            </a>
                    @endforeach    
                    @else
                        <p class="text-sm text-black/50">No conversations.</p>
                    @endif  
                </h2>
            </div>
            <div class="card w-full">
                <div class="flex flex-col flex-1 ring-1 ring-black/20 rounded-lg overflow-clip">
                    <div class="flex">
                        <div id="noConversation" class="flex flex-col flex-1 w-full min-h-[60vh] max-h-[60vh] items-center justify-center">
                            <p class="text-lg text-black/50">Click a conversation.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if(checkRole(auth()->user(), [5]))

        <div class="card">
            <div class="flex flex-col flex-1 ring-1 ring-black/20 rounded-lg overflow-clip">
                <div class="flex">
                    @if ($conversation)
                        <div id="messages" class="flex flex-col w-full mt-auto p-5 overflow-y-auto min-h-[60vh] max-h-[60vh]">
                            @foreach ($conversation->messages as $message)
                                <div class="flex {{$message->sender_user_id ? 'text-right' : 'justify-start'}}">
                                    @if(!$message->sender_user_id)
                                        <div class="flex items-center justify-center bg-blue-950 self-end rounded-full min-w-[40px] min-h-[40px]">
                                            <img src="" alt="a">
                                        </div>
                                    @endif
                                        <p class="py-6 ml-5 w-full rounded-xl even:bg-slate-100 {{$message->sender_user_id ?? 'px-4'}} ">{{$message->message}}</p>
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
                    <input id="inputField" type="text" list="prompts" placeholder="Ask something" class="p-2 input rounded-none">
                    <button id="sendBtn" data-sendUrl="{{route('chatbot.send')}}" data-conversationId="{{$conversation->id ?? null}}" class="px-5">Send</button>
                </div>
            </div>
        </div>
    @endif

    @vite('resources/js/chatBot.js')

</x-layout>

<datalist id="prompts">
    <option value="How do I format chapter titles and subheadings consistently throughout my thesis?"></option>
    <option value="What should be included in the acknowledgment section of the thesis?"></option>
    <option value="How many references should I include in my literature review?"></option>
    <option value="Can you recommend some reliable sources for literature review?"></option>
    <option value="What font size and style should I use for my thesis?"></option>
    <option value="How do I properly cite sources in my thesis?"></option>
    <option value="Should I include footnotes or endnotes in my thesis?"></option>
    <option value="What is the preferred citation style for our department?"></option>
    <option value="How do I format block quotes in my thesis?"></option>
    <option value="How do I format citations for sources with multiple authors in APA style?"></option>
    <option value="How do I cite a source that has multiple authors in my thesis?"></option>
    <option value="Can I include charts and graphs in my thesis? If yes, how should they be formatted?"></option>
    <option value="What is the standard margin size for the thesis document?"></option>
    <option value="How do I format in-text citations for multiple sources in one sentence?"></option>
    <option value="How do I format long quotations in my thesis?"></option>
    <option value="How do I write an effective introduction for my capstone project/thesis?"></option>
    <option value="What is the difference between a qualitative and quantitative research methodology?"></option>
    <option value="What should be the minimum and maximum number of sources in the literature review?"></option>
    <option value="Can you provide a step-by-step guide for writing the Chapter 1 to 3?"></option>
    <option value="What should be the format of the research objectives in Chapter 1?"></option>
    <option value="How to establish the scope and limitations of the study in Chapter 1?"></option>
    <option value="Can you recommend research databases for my literature review?"></option>
    <option value="What is the significance of the table of contents, and how do I create it properly?"></option>
    <option value="What elements should be included in the introduction chapter, and how should it be organized?"></option>
    <option value="How do I choose my research methodology?"></option>
    <option value="How can I improve the organization of my thesis chapters?"></option>
    <option value="Can you recommend software for data analysis?"></option>
    <option value="What ethical considerations should I keep in mind for my research?"></option>
    <option value="What is the ideal structure for the introduction chapter?"></option>
    <option value="What are the best practices for conducting interviews or surveys?"></option>
    <option value="Can you help me understand statistical analysis methods?"></option>
    <option value="How do I choose the right research instruments for data collection?"></option>
    <option value="What is the role of the theoretical framework in my thesis?"></option>
    <option value="Can you suggest ways to engage my audience during the presentation?"></option>
    <option value="How can I improve the clarity of my research methodology section?"></option>
    <option value="How do I defend my research methodology during presentations?"></option>
    <option value="How do I create an annotated bibliography for my literature review?"></option>
    <option value="Can you recommend tools for plagiarism checking?"></option>
    <option value="Can you provide guidelines for writing an abstract?"></option>
    <option value="How do I choose appropriate research variables?"></option>
    <option value="How do I create a compelling introduction for my thesis?"></option>
    <option value="Can you provide tips for effective research note-taking?"></option>
    <option value="How do I avoid plagiarism in my thesis or capstone project?"></option>
    <option value="How do I structure my literature review based on themes or theories?"></option>
    <option value="How do I conduct a thorough and effective literature search?"></option>
    <option value="How do I choose the right keywords for my literature search?"></option>
    <option value="Should I include a summary of methodology in the introduction section?"></option>
    <option value="How do I create a timeline for data collection and analysis?"></option>
    <option value="Can you recommend some online platforms for conducting surveys and collecting research data?"></option>
    <option value="Can you recommend software for managing citations and references in my thesis?"></option>
    <option value="Can you provide guidance on writing the research methodology in Chapter 3?"></option>
    <option value="How do I describe the research design and approach effectively in Chapter 3?"></option>
    <option value="What is the importance of the population and sample selection section in Chapter 3?"></option>
    <option value="Can you explain the process of data collection and instruments used in Chapter 3?"></option>
    <option value="What should be the format of the results presentation in Chapter 4?"></option>
    <option value="Can you provide guidelines on organizing quantitative results logically in Chapter 4?"></option>
    <option value="How do I create effective visual representations of data in Chapter 4?"></option>
    <option value="What is the importance of interpreting the results in the context of the research questions in Chapter 4?"></option>
</datalist>