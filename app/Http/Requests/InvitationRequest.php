<?php

namespace App\Http\Requests;

use App\Models\Invitation;
use App\Rules\UniqueCompositeKeys;
use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //$invites = Invitation::where('invitee_id', request()->inviteeId)->where('inviter_id',auth()->id())->get();
        return [
            'invitee_id' => ['required', new UniqueCompositeKeys]
        ];

    }
}
