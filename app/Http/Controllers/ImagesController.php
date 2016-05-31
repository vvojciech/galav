<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Image;
use App\Tag;
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
    public function index($sort = 'default') {

        // validate sorting
        if (!in_array($sort, ['default', 'hot', 'fresh'])) {
            $sort = 'default';
        }
        // get the default one
        if ($sort == 'default') {
            $sort = Config::get('custom.images.default_sort');
        }

        // map sorting and adjust title
        $order = ['id', 'DESC'];
        $title = 'Newest images';
        switch ($sort) {
            case 'hot':
                $order = ['rating', 'ASC'];
                $title = 'Hottest images';
                break;
        }

        $images = Image::orderBy($order[0], $order[1])->paginate(Config::get('custom.images.pagination'));

        return view ('images.index', [
            'images' => $images,
            'title' => $title,
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
    public function store(ImageRequest $request)
    {

        // get unique filename
        $filename = Image::getUniqueFilename();
        $request->merge(array('filename' => $filename));

        // create file
        $image = $request->user()->images()->create(
            $request->all()
        );

        // create tags
        $tag_ids = [];
        $tags = explode(',', $request->get('tags'));
        foreach ($tags as $tag) {
            $tag = trim(strtolower($tag));
            $tag = Tag::firstOrCreate(['tag' => $tag]);
            $tag_ids[] = $tag->id;
        }

        // sync tags with inputs
        $image->tags()->sync($tag_ids);


        // move uploaded file
        $request->file('upload_file')->move(
            base_path() . '/public/images/', $filename
        );

        return redirect('/i/' . $filename)->with('message', 'Image uploaded successfully');
    }

    /**
     * @param $filename
     */
    public function file($filename, $size = 'original') {

        // @todo file exists


        $img = \ImageFile::make(
                public_path() . '/images/' . $filename
            )->resize(300, 200);

        return $img->response('jpg');

    }
}
