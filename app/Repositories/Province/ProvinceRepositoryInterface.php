<?php

namespace App\Repositories\Province;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ProvinceRepositoryInterface
{
    /**
     * Get province detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getProvinceDetail(array $condition, $columns = ['*']);
}
