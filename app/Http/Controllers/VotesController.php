<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Image;
use App\Vote;
use Illuminate\Support\Facades\Request;

class VotesController extends Controller
{
    public function vote(VoteRequest $request)
    {

        $filename = $request->get('filename');
        $vote_string = $request->get('vote');

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

            return response()->json([
                'error' => '0',
                'votes_total' => $image->votes_total,
                'votes_up' => $image->votes_up,
                'votes_down' => $image->votes_down,
            ]);

            //return redirect('/i/' . $filename)->with('message', 'Vote successful');

        } else {

            return response()->json(['error' => '1', 'result' => '']);

            //return redirect('/i/' . $filename)->with('error', 'Unknown error');
        }

    }
}
