<?php

namespace App\Services\Business\RoomType;

interface RoomTypeServiceInterface
{
    /**
     * getList
     *
     * @param  mixed $condition
     * @param  mixed $columns
     * @return void
     */
    public function getList(array $condition = [], $columns = ['*']);
}
