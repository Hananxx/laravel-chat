<?php

namespace App\Http\Controllers;

use App\Actions\AcceptInvitation;
use App\Events\NewInvitation;
use App\Http\Requests\InvitationRequest;
use App\Models\ChatRoom;
use App\Models\Invitation;
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
        return AcceptInvitation::run(Invitation::find($request->inviteId));
    }

    public function rejectInvitation(Request $request)
    {
        return Invitation::find($request->id)->delete();
    }
}
