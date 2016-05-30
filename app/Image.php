<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Image extends Model
{

    protected $fillable = [
        'user_id',
        'filename',
        'title',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function search($query)
    {
        return self::where('title', 'LIKE', '%' . $query . '%')->paginate(Config::get('custom.images.pagination'));
    }

    /**
     * @param $id
     */
    public static function findByUserId($user_id)
    {
        return self::where('user_id', $user_id)->paginate(Config::get('custom.images.pagination'));
    }

    /**
     * @param $filename
     * @return mixed
     */
    public static function getByFilename($filename)
    {
        return self::where('filename', $filename)->first();
    }

    /**
     * @return string
     */
    public static function getUniqueFilename()
    {
        do {
            $filename = str_random(6);
            $found = self::getByFilename($filename);

        } while ($found);

        return $filename;
    }


    /**
     * @param $image
     * @param $vote
     */
    public static function addVote($image, $vote)
    {

        $image->votes_total++;

        if ($vote > 0) {
            $image->votes_up++;
        } else {
            $image->votes_down++;
        }

        $image->rating = ($image->votes_up / $image->votes_total) * 100000;

        return $image->save();

    }



}
