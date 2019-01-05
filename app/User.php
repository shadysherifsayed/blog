<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const DEFAULT_AVATAR = 'images/defaults/avatar.png';
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** Accessors */
    public function getAvatarAttribute($avatar)
    {
        return $avatar ? asset("storage/$avatar") : asset(self::DEFAULT_AVATAR);
    }
    /** Accessors */
}
