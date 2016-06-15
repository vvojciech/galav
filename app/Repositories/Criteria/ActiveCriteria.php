<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 15/06/16
 * Time: 20:40
 */

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActiveCriteria
 * @package App\Repositories\Criteria
 */
class ActiveCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('active','=', 1);
        return $model;
    }
}
