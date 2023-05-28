<?php

namespace App\Services\Business\District;

use Illuminate\Database\Eloquent\Model;

interface DistrictServiceInterface
{
    /**
     * getList
     *
     * @param  mixed $condition
     * @param  mixed $columns
     * @return void
     */
    public function getList(array $condition = [], $columns = ['*']);

    /**
     * Get district detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
