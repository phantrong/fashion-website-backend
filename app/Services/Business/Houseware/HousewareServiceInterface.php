<?php

namespace App\Services\Business\Houseware;

use Illuminate\Database\Eloquent\Model;

interface HousewareServiceInterface
{
    /**
     * List all housewares by admin
     *
     * @param array $condition
     * @return array
     */
    public function getListByAdmin(array $condition);

    /**
     * Get houseware detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
