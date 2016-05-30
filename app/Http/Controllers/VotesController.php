<?php

namespace App\Http\Controllers;

use App\Image;
use App\Vote;
use Illuminate\Support\Facades\Request;

class VotesController extends Controller
{
    public function vote($filename, $vote_string)
    {

        // validate
        $image = Image::getByFilename($filename);
        if (!$image) {
            return redirect('/')->with('error', 'Image not found');
        }

        if (!in_array($vote_string, array('up', 'down'))) {
            return redirect('/i/' . $filename)->with('error', 'Incorrect vote');
        }

        // @todo check for vote flood



        $vote = 1;
        if ($vote_string == 'down') {
            $vote = -1;
        }

        if (Vote::addVote($image, $vote, Request::ip()))
        {
            Image::addVote($image, $vote);
            return redirect('/i/' . $filename)->with('message', 'Vote successful');

        } else {
            return redirect('/i/' . $filename)->with('error', 'Unknown error');
        }

    }
}
