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
        $userId = auth()->id();

        $invites = Invitation::where('invitee_id', $value)
                    ->where('inviter_id', $userId)->first();

        $inverse = Invitation::where('inviter_id', $value)
                    ->where('invitee_id', $userId)->first();

        return !$invites && !$inverse;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'An invitation from/to this user already exists.';
    }
}
