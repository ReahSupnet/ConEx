<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body', 'thread_id', 'user_id', 'status', 'vote_up', 'vote_down'
    ];

    const STATUSES = array('open' => 0, 'blocked' => 1, 'deleted' => 2);


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

}
