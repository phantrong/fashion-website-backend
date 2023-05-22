<?php

namespace App\Services\Business\District;

use Illuminate\Database\Eloquent\Model;

interface DistrictServiceInterface
{
    /**
     * List all districts.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get district detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
