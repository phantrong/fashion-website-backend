<?php

namespace App\Services\Business\Province;

use Illuminate\Database\Eloquent\Model;

interface ProvinceServiceInterface
{
    /**
     * List all provinces.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get province detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
