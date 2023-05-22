<?php

namespace App\Repositories\Ward;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface WardRepositoryInterface
{
    /**
     * Get ward detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getWardDetail(array $condition, $columns = ['*']);
}
