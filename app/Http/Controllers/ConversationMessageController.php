<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;
use \Questions;

class ConversationMessageController extends Controller
{
    public function sendMessage(Request $request) {
        
        if(!$request->conversationId) {
            $conversation = Conversation::create(['user_id' => auth()->user()->id]);
        }else {
            $conversation = Conversation::find($request->conversationId);
        }
        
        $conversation->messages()->create([
            'sender_user_id' => auth()->user()->id,
            'message' => $request->message
        ]);

        // create logic here to get the response
        $questions = getChatBotData();
        if(array_key_exists($request->message, $questions)) {
            $response = $questions[$request->message];
        }else{
            if(auth()->user->id != 1) {
                $response = "I'm sorry I cannot answer this question. Please wait for a response from the admin.";
            }
        }

        $conversation->messages()->create([
            'sender_user_id' => null,
            'message' => $response
        ]);

        return response()->json([
            'message' => $response,
            'senderUserId' => null,
            'conversationId' => $conversation->id
        ], 200);
    }
}
