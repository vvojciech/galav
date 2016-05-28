<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'user_id',
        'filename',
        'title',
    ];

    public static function search($query)
    {
        return self::where('title', 'LIKE', '%' . $query . '%')->paginate(100);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $filename
     * @return mixed
     */
    public static function findByFilename($filename)
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
            $found = self::findByFilename($filename);

        } while ($found);

        return $filename;
    }


}
