<?php

namespace App\Repositories\Room;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface RoomRepositoryInterface
{
    /**
     * getListByAdmin
     *
     * @param  array $condition
     * @return object
     */
    public function getListByAdmin(array $condition);

    /**
     * getDetailByAdmin
     *
     * @param  int $id
     * @param  array $condition
     * @return object
     */
    public function getDetailByAdmin($id, array $condition);

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getRoomDetail(array $condition, $columns = ['*']);
    
    /**
     * getListByUser
     *
     * @param  array $condition
     * @return object
     */
    public function getListByUser(array $condition);
    
    /**
     * getDetailByUser
     *
     * @param  int $id
     * @param  array $condition
     * @return object
     */
    public function getDetailByUser($id, array $condition);
}
