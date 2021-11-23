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
    //public $id;
    public function __construct()
    {
       // $this->id = $id;
        //dd(12);
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
        return count($invites) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'an Invitation already sent to this user.';
    }
}
