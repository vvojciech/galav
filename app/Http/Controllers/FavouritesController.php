<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Http\Requests\FavouriteRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function toggle (FavouriteRequest $request)
    {
        // @todo move to request, see request
        // validate
        $image = Image::getByFilename($request->get('filename'));
        if (!$image) {
            return redirect('/')->with('error', 'Image not found');
        }
        // @todo flood control

        // @todo better control on action

        if ($request->get('action') == 'remove') {
            $favourites = Favourite::where('image_id', $image->id)->where('user_id', Auth::user()->id);
            if ($favourites->count() == 1) { // all good
                Favourite::destroy($favourites->first()->id);
            } else {
                // todo report error
            }

            return redirect('/i/' . $request->get('filename'))->with('message', 'Image was removed from favourites');

        } else {
            $request->merge(array('image_id' => $image->id));

            $favourite = $request->user()->favourites()->create(
                $request->all()
            );

            return redirect('/i/' . $request->get('filename'))->with('message', 'Image was added to favourites');
        }


    }
}
