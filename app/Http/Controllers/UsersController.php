<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Image;
use App\User;

use App\Http\Requests;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{

    /**
     * @param $username
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploaded($username, Image $image) {
        
        $user = User::findByUsername($username);
        $images = $image->findByUserId($user->id);

        return view('images.index', [
            'user' => $user,
            'images' => $images,
            'title' => 'Images of ' . $user->username,
        ]);
    }

    /**
     * @todo rewrite this to custom query
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favourites($username) {

        $user = User::findByUsername($username);

        $favourites = Favourite::findFavouriteImagesByUserId($user->id);

        $images = ($favourites->pluck('image'));

        $pagination = new Paginator($images, count($images), 5);

        return view('images.index', [
            'user' => $user,
            'images' => $pagination,
            'title' => 'Favourite images of ' . $user->username,
        ]);
    }
}
