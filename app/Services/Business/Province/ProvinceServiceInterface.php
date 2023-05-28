<?php

namespace App\Services\Business\Province;

use Illuminate\Database\Eloquent\Model;

interface ProvinceServiceInterface
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
     * Get province detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
