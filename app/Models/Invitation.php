<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'inviter_id', 'invitee_id', 'status'
    ];

    public function inviter(){
        return $this->belongsTo(User::class, 'inviter_id', 'id');
    }

    public function invitee(){
        return $this->belongsTo(User::class, 'invitee_id', 'id');
    }

}
