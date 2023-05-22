<?php

namespace App\Services\Business\Houseware;

use Illuminate\Database\Eloquent\Model;

interface HousewareServiceInterface
{
    /**
     * List all housewares.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get houseware detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
