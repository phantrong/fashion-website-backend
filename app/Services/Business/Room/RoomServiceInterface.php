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
     * @param $id
     * @return Model
     */
    public function getDetail($id);
}
