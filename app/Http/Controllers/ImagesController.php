<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImagesController extends Controller
{

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $images = Image::all();

        return view ('images.index', [
            'images' => $images
        ]);
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function show($filename) {

        $image = Image::findByFilename($filename);

        return view('images.show', ['image' => $image]);
    }

    /**
     * @return mixed
     */
    public function create() {
        return view ('images.create');
    }

    /**
     *
     */
    public function store(ImageRequest $request) {

        // get unique filename
        $request->merge(array('filename' => Image::getUniqueFilename()));

        $request->user()->images()->create(
            $request->all()
        );

        return redirect('/');
    }

}
