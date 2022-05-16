<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Twit extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function twitComment()
    {
        return $this->hasMany(TwitComment::class);
    }
}
