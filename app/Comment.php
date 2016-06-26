<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'image_id',
        'parent_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @param $image_id
     */
    public static function findByImageId($image_id)
    {
        return self::where('image_id', $image_id)->with('user')->orderBy('id', 'DESC')->get();
    }


}
