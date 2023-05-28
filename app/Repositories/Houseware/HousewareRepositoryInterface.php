<?php

namespace App\Repositories\Houseware;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface HousewareRepositoryInterface
{
    /**
     * Get houseware detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getHousewareDetail(array $condition, $columns = ['*']);
    
    /**
     * getListByAdmin
     *
     * @param  array $condition
     * @param $columns
     * @return LengthAwarePaginator
     */
    public function getListByAdmin(array $condition, $columns = ['*']);
}
