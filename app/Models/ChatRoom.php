<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function messages(){
        return $this->hasMany(ChatMessage::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
