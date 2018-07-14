<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function threadCount()
    {
        return count($this->threads);
    }
}
