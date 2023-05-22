<?php

namespace App\Repositories\District;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface DistrictRepositoryInterface
{
    /**
     * Get district detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getDistrictDetail(array $condition, $columns = ['*']);
}
