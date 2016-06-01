<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function store(CommentRequest $request)
    {

        // @todo validate in request
        // validate
        $image = Image::getByFilename($request->get('filename'));
        if (!$image) {
            return redirect('/')->with('error', 'Image not found');
        }
        // @todo flood control

        $request->merge([
            'image_id' => $image->id,
            'parent_id' => 0, // @todo replace it with parent comment
        ]);

        $report = $request->user()->comments()->create(
            $request->all()
        );

        return redirect('/i/' . $request->get('filename'))->with('message', 'Your comment was added');

    }
}
