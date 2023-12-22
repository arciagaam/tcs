<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatbotStoreRequest;
use App\Http\Requests\ChatbotUpdateRequest;
use App\Models\ChatBotSetting;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if(!checkRole($user, [1,5])) {
            return redirect('/');
        }

        if(checkRole($user, [1])) {
            $chatBotData = getChatBotData();
            $prompts = [];

            foreach($chatBotData as $key => $value) {
                array_push($prompts, $key);
            }
            
            $inbox = DB::table('conversations')
            ->join('users', 'users.id', 'conversations.user_id')
            ->where('conversations.user_id', '!=', 1)
            ->get()->all();

            $conversation = Conversation::whereHas('messages', function($q) {
                $q->oldest();
            })->where('user_id', $user->id)->first();
            return view('pages.chatbot.index', compact('inbox', 'conversation', 'prompts'));
            
        } else {

            $chatBotData = getChatBotData();
            $prompts = [];

            foreach($chatBotData as $key => $value) {
                array_push($prompts, $key);
            }

            $conversation = Conversation::whereHas('messages', function($q) {
                $q->oldest();
            })->where('user_id', $user->id)->first();
            return view('pages.chatbot.index', compact('conversation', 'prompts'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatbotStoreRequest $request)
    {
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }

        foreach($request->validated() as $key => $setting) {
            ChatBotSetting::updateOrCreate(
            ['message_type' => $key],    
            [
                'message_type' => $key,
                'value' => $setting 
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!checkRole(auth()->user(), [1])) {
            return redirect('/');
        }
        // dd($chatbot);

        $inbox = DB::table('conversations')
        ->join('users', 'users.id', 'conversations.user_id')
        ->where('conversations.user_id', '!=', 1)
        ->get()->all();
         
        $chatBotData = getChatBotData();
            $prompts = [];

        foreach($chatBotData as $key => $value) {
            array_push($prompts, $key);
        }

        $conversation = Conversation::whereHas('messages', function($q) {
            $q->oldest();
        })->where('user_id', $id)->first();

        return view('pages.chatbot.show', compact('inbox', 'id', 'conversation'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }
        
        //
    }
}
