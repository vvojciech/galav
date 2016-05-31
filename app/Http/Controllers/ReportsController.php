<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportsController extends Controller
{
    public function report(ReportRequest $request)
    {

        // validate
        $image = Image::getByFilename($request->get('filename'));
        if (!$image) {
            return redirect('/')->with('error', 'Image not found');
        }
        // @todo flood control

        $request->merge(array('image_id' => $image->id));

        $report = $request->user()->reports()->create(
            $request->all()
        );

        return redirect('/i/' . $request->get('filename'))->with('message', 'Thank you for reporting. We will look into it shortly');

    }
}
