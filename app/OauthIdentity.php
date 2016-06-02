<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthIdentity extends Model
{

    protected $fillable = [
        'user_id',
        'provider',
        'uid',
    ]; 
}
