<?php

namespace App\Services\Business\Ward;

use Illuminate\Database\Eloquent\Model;

interface WardServiceInterface
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
     * Get ward detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
