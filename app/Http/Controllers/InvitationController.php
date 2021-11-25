<?php

namespace App\Http\Controllers;

use App\Events\NewInvitation;
use App\Http\Requests\InvitationRequest;
use App\Models\ChatRoom;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPendingInvitations(Request $request)
    {
        return Invitation::with('inviter')
            ->where('invitee_id', Auth::id())
            ->where('status', 'pending')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInvitation(InvitationRequest $request)
    {
        $newInvitation =  Invitation::create([
            'inviter_id' => Auth::id(),
            'invitee_id' => $request->invitee_id,
            'status' => 'pending'
        ]);
        if($newInvitation->save()) {
            broadcast(new NewInvitation($newInvitation))->toOthers();
        }

        return $newInvitation;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acceptInvitation(Request $request)
    {
        //$request status accept or reject
        $invitation = Invitation::find($request->inviteId);
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
        return 'room created!';
    }

    public function rejectInvitation(Request $request)
    {
        return Invitation::find($request->id)->delete();
    }
}
