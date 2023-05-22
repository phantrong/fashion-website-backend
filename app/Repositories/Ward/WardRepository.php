<?php

namespace App\Repositories\Ward;

use App\Models\Ward;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    /**
     * WardRepository constructor.
     *
     * @param Ward $ward
     */
    public function __construct(Ward $ward)
    {
        parent::__construct($ward);
    }

    /**
     * Get ward detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getWardDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
