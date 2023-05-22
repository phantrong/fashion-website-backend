<?php

namespace App\Repositories\Province;

use App\Models\Province;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    /**
     * ProvinceRepository constructor.
     *
     * @param Province $province
     */
    public function __construct(Province $province)
    {
        parent::__construct($province);
    }

    /**
     * Get province detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getProvinceDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
