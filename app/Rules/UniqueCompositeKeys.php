<?php

namespace App\Rules;

use App\Models\Invitation;
use Illuminate\Contracts\Validation\Rule;

class UniqueCompositeKeys implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $invites = Invitation::where('invitee_id', $value)->where('inviter_id',auth()->id())->get();
        $inverse = Invitation::where('inviter_id', $value)->where('invitee_id',auth()->id())->get();
        return count($invites) == 0 && count($inverse) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'An invitation has already been sent to this user.';
    }
}
