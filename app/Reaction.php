<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'target_id', 'user_id', 'target_type', 'reaction'
    ];

    const REACTIONS = array('vote_up' => 0, 'vote_down' => 1);
}
