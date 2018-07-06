<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body', 'thread_id', 'user_id', 'status', 'vote_up', 'vote_down'
    ];

    const STATUSES = array('open' => 0, 'blocked' => 1);
}
