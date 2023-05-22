<?php

namespace App\Repositories\District;

use App\Models\District;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    /**
     * DistrictRepository constructor.
     *
     * @param District $district
     */
    public function __construct(District $district)
    {
        parent::__construct($district);
    }

    /**
     * Get district detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getDistrictDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
