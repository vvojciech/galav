<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Favourite;
use App\Http\Requests\ImageRequest;
use App\Image;
use App\ReportReason;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ImagesController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($sort = 'default')
    {

        // validate sorting
        if (!in_array($sort, ['default', 'hot', 'fresh'])) {
            $sort = 'default';
        }
        // get the default one
        if ($sort == 'default') {
            $sort = Config::get('custom.images.default_sort');
        }

        // sort sorting in session
        Session::put('images.sort', $sort);

        // map sorting and adjust title
        $imagesQuery = Image::orderBy('id', 'DESC');
        $title = 'Newest images';
        switch ($sort) {
            case 'hot':
                $imagesQuery = Image::orderBy('rating', 'DESC')->orderBy('id', 'DESC');
                $title = 'Hottest images';
                break;
        }

        $images = $imagesQuery->paginate(Config::get('custom.images.pagination'));


        return view('images.index', [
            'images' => $images,
            'title' => $title,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {

        $images = Image::search($request->get('search-query'));

        return view('images.index', [
            'images' => $images,
            'title' => 'Search results for ' . $request->get('search-query'),
        ]);
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function show($filename)
    {
        $image = Image::getByFilename($filename);

        $blank_reason = collect(['0' => '---']);

        return view('images.show', [
            'image' => $image,
            'report_reasons' => $blank_reason->merge(ReportReason::lists('reason', 'id')),
            'comments' => Comment::findByImageId($image->id),
            'neighbours' => Image::getNeighbours(Session::get('images.sort'), $image),
            'favourite' => (
            Auth::check()
                ? Favourite::where('image_id', $image->id)->where('user_id', Auth::user()->id)->first()
                : null
            )
        ]);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('images.create');
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
    public function file($filename, $size = 'original')
    {

        $img = null;

        switch ($size) {
            case 't': //thumb

                $img = \ImageFile::make(
                    public_path() . '/images/' . $filename
                );
                $ratio = $img->width() / $img->height();
                $width = $height = 350;

                if ($ratio < 0.5) {
                    $height = 700;
                } 

                $img->fit($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                return $img->response();

            default:
                $response = Response::make(File::get(public_path() . '/images/' . $filename));

                // todo fix headers here please
                $response->header('Content-Type', 'image/gif');
                return $response;
        }

    }
}
