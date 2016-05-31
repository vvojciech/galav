<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportReason extends Model
{

    public $timestamps = false;

    public function Reports()
    {
        return $this->hasMany(Report::class);
    }
}
