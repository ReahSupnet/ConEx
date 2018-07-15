<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const STATUSES = array('active' => 0, 'banned' => 1);
    const ROLES = array('member' => 0, 'admin' => 1);
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role == User::ROLES['admin'];
    }

    public function printRole()
    {
        return array_search($this->role, User::ROLES);
    }

    public function printStatus()
    {
        return array_search($this->status, User::STATUSES);
    }

    public function isBanned()
    {
        return $this->status == User::STATUSES['banned'];
    }
}
