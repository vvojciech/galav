<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class); 
    }

    public static function findByUsername($username)
    {
        return self::where('username', $username)->first();
    }
}
