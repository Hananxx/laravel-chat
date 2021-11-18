<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at')
            ->get();
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = ChatMessage::create([
            'user_id' => Auth::id(),
            'chat_room_id' => $roomId,
            'message' => $request->message
        ]);
        if($newMessage->save()){
            broadcast(new NewChatMessage($newMessage));
        }
        return $newMessage;
    }

}
