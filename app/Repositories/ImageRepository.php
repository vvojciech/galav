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
     * Custom method for getting paginated results by our dynamic criteria
     */
    public function findIndex(array $params = [], $sort, $page)
    {

        // validate sorting
        if (!in_array($sort, ['default', 'hot', 'fresh'])) {
            $sort = 'default';
        }
        // get the default one
        if ($sort == 'default') {
            $sort = Config::get('custom.images.default_sort');
        }

        $order = ['id', 'DESC'];

        switch ($sort) {
            case 'hot':
                $order = ['rating', 'ASC'];
                break;
        }

        return $this->orderBy($order[0], $order[1])->paginate(Config::get('custom.images.pagination'));

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