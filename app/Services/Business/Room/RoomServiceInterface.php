<?php

namespace App\Services\Business\Room;

use Illuminate\Database\Eloquent\Model;

interface RoomServiceInterface
{
    /**
     * List all rooms by admin
     *
     * @param array $condition
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
    public function getDetailByAdmin($id, array $condition = []);

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param int $id
     * @return Model
     */
    public function getDetail($condition, $id);

    /**
     * getListSearchByUser
     *
     * @param  array $condition
     * @return object
     */
    public function getListSearchByUser(array $condition = []);

    /**
     * getDetailByUser
     *
     * @param  int $id
     * @param  array $condition
     * @return object
     */
    public function getDetailByUser($id, array $condition = []);

    /**
     * getCountRoomInHanoi
     *
     * @param  array $condition
     * @return object
     */
    public function getCountRoomInHanoi($condition = []);
}
