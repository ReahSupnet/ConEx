<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded=[];
    protected $fillable = [
        'subject', 'category_id', 'user_id', 'status', 'vote_up', 'vote_down'
    ];

    const STATUSES = array('open' => 0, 'closed' => 1);

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
