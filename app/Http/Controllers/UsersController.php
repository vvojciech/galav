<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Image;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class UsersController extends Controller
{

    public function uploaded($username) {

        $user = User::findByUsername($username);
        $images = Image::findByUserId($user->id);

        return view('images.index', [
            'user' => $user,
            'images' => $images,
            'title' => 'Images of ' . $user->username,
        ]);
    }

    public function favourites($username) {

        $user = User::findByUsername($username);

        $favourites = Favourite::findFavouriteImagesByUserId($user->id);
        $images = ($favourites->pluck('image'));

        return view('images.index', [
            'user' => $user,
            'images' => $images,
            'title' => 'Favourite images of ' . $user->username,
        ]);
    }
}
