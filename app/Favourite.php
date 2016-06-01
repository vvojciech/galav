<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Favourite extends Model
{
    protected $fillable = [
        'user_id',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public static function findFavouriteImagesByUserId($user_id)
    {
        return self::where('user_id', $user_id)->paginate(Config::get('custom.images.pagination'));
    }

}
