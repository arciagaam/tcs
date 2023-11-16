<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;

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
        $sampleResponse = "No available data";

        $conversation->messages()->create([
            'sender_user_id' => null,
            'message' => $sampleResponse
        ]);

        return response()->json([
            'message' => $sampleResponse,
            'senderUserId' => null,
            'conversationId' => $conversation->id
        ], 200);
    }
}
