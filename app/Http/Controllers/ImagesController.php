<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ImagesController extends Controller
{

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $images = Image::paginate(Config::get('custom.images.pagination'));

        return view ('images.index', [
            'images' => $images,
            'title' => 'Newest images',
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request) {

        $images = Image::search($request->get('search-query'));

        return view ('images.index', [
            'images' => $images,
            'title' => 'Search results for ' . $request->get('search-query'),
        ]);
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function show($filename) {

        $image = Image::getByFilename($filename);

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
        $filename = Image::getUniqueFilename();
        $request->merge(array('filename' => $filename));

        // create file
        $request->user()->images()->create(
            $request->all()
        );

        // move uploaded file
        $request->file('upload_file')->move(
            base_path() . '/public/images/', $filename
        );

        return redirect('/i/' . $filename)->with('message', 'Image uploaded successfully');
    }

}
