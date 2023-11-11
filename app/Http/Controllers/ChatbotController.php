<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatbotStoreRequest;
use App\Http\Requests\ChatbotUpdateRequest;
use App\Models\ChatBotSetting;
use App\Models\Conversation;
use Illuminate\Http\Request;

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
            $settingsObject = [];
    
            foreach(ChatBotSetting::get() as $setting) {
                $messageType = $setting->message_type;
                $settingsObject[$messageType] = (object) $setting;
            }
            
            $settings = collect($settingsObject);
            return view('pages.chatbot.index', compact('settings'));
        } else {

            $conversation = Conversation::whereHas('messages', function($q) {
                $q->oldest();
            })->where('user_id', $user->id)->first();
            return view('pages.chatbot.index', compact('conversation'));
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
        if(!checkRole(auth()->user(), [1,5])) {
            return redirect('/');
        }

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
