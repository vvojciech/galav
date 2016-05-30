<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;

    protected $fillable = ['image_id', 'vote', 'ip', 'day'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }


    public static function addVote($image, $vote, $ip)
    {

        return self::create([
            'image_id' => $image->id,
            'vote' => $vote,
            'ip' => $ip,
            'day' => date('Y-m-d'),
        ]);

    }

}
