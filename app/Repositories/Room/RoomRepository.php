<?php

namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    /**
     * RoomRepository constructor.
     *
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getRoomDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
