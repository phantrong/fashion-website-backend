<?php

namespace App\Services\Business\Room;

use Illuminate\Database\Eloquent\Model;

interface RoomServiceInterface
{
    /**
     * List all rooms.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param int $id
     * @return Model
     */
    public function getDetail($condition, $id);
}
