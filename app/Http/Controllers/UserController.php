<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{


    public function show($username) {

        $user = User::findByUsername($username);
        $images = Image::findByUserId($user->id);
        
        return view('user.show', [
            'user' => $user,
            'images' => $images,
            'title' => 'Images of ' . $user->username, 
        ]);
    }
}
