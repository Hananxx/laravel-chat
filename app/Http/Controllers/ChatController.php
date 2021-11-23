<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return (ChatRoom::where('privacy', 'public')->get())->concat(User::find(Auth::id())->rooms);
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
            broadcast(new NewChatMessage($newMessage))->toOthers();
        }
        return $newMessage;
    }

    public function startNewChatRoom(Request $request)
    {
//        //create a new chat room
//        $newRoom =  ChatRoom::create([
//            'name' => 'tfoeifih',
//            'privacy' => 'private'
//        ]);
//
//        if($newRoom->save()){
//            //inviter pivot record
//            $userId = Auth::id();
//            DB::table('chat_room_user')->insert([
//                'user_id' => $userId,
//                'chat_room_id' => $newRoom->id,
//            ]);
//
//            //invited user pivot record
//            DB::table('chat_room_user')->insert([
//                'user_id' => $request->id,
//                'chat_room_id' => $newRoom->id,
//            ]);
//        }
        return 'done!';
    }

    public function getPendingInvites(Request $request){
        $u = User::find(Auth::id());
        $u->rooms->pluck('pivot')->where('accepted',0);
        //$u->rooms->pluck('pivot')->where('accepted',1)
        //->concat()


    }
}
