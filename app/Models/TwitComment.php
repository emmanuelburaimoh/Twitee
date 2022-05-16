<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitComment extends Model
{
    public function twit()
    {
        return $this->belongsTo(Twit::class, 'foreign_key');
    }
}
