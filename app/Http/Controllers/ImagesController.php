<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;

class ImagesController extends Controller
{

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        Flash::message('Image uploaded successfully');

        $images = Image::all();

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
        $filename = Image::getUniqueFilename();
        $request->merge(array('filename' => $filename));

        $request->user()->images()->create(
            $request->all()
        );

        Flash::message('Image uploaded successfully');

        return redirect('/i/' . $filename);
    }

}
