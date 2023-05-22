<?php

namespace App\Services\Business\Ward;

use Illuminate\Database\Eloquent\Model;

interface WardServiceInterface
{
    /**
     * List all wards.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get ward detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
