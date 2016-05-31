<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [
        'user_id',
        'image_id',
        'report_reason_id',
    ];


    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report_reason()
    {
        return $this->belongsTo(ReportReason::class);
    }

}
