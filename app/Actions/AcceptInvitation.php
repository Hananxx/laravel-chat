<?php

namespace App\Actions;

use App\Models\ChatRoom;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Action;
use Lorisleiva\Actions\Concerns\AsAction;

class AcceptInvitation extends Action
{
    use AsAction;

    public function handle($invite)
    {
        //$request status accept or reject
        $invitation = $invite;
        $room =  ChatRoom::create([
            'name' => $invitation->inviter->name.', '.$invitation->invitee->name,
            'privacy' => 'private'
        ]);
        if($room->save())
        {
            //inviter pivot record
            DB::table('chat_room_user')->insert([
                'user_id' => $invitation->inviter->id,
                'chat_room_id' => $room->id,
            ]);

            //invitee pivot record
            DB::table('chat_room_user')->insert([
                'user_id' => $invitation->invitee->id,
                'chat_room_id' => $room->id,
            ]);

            $invitation->update([
                'status' => 'accepted'
            ]);
        }

    }
}
