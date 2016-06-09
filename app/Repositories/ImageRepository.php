<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 09/06/16
 * Time: 21:51
 */

namespace App\Repositories;
use Illuminate\Support\Facades\Config;
use Prettus\Repository\Eloquent\BaseRepository;

class ImageRepository extends BaseRepository
{
    function model()
    {
        return \App\Image::class;
    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  int $user_id
     * @return Collection
     */
    public function findByUserId($user_id)
    {
        return $this->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->paginate(Config::get('custom.images.pagination'));
        
    }

}