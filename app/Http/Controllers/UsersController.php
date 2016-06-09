<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Image;
use App\Repositories\ImageRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class UsersController extends Controller
{

    /**
     * @param $username
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploaded($username, ImageRepository $imageRepository) {
        
        $user = User::findByUsername($username);
        $images = $imageRepository->findByUserId($user->id);

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
//        dd($favourites->pluck('image'));

        $images = ($favourites->pluck('image'));

        $pagination = new Paginator($images, count($images), 5);

        return view('images.index', [
            'user' => $user,
            'images' => $pagination,
            'title' => 'Favourite images of ' . $user->username,
        ]);
    }
}
