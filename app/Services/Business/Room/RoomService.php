<?php

namespace App\Services\Business\Room;

use App\Enum\RoomEnum;
use App\Helpers\PaginationHelper;
use App\Models\Room;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use Illuminate\Database\Eloquent\Model;

class RoomService extends BasesBusiness implements RoomServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Room $room)
    {
        $this->model = $room;
        $this->repository = Repository::getRoom();
    }

    /**
     * List all rooms.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $rooms = Repository::getRoom()->getListPagination($condition, RoomEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($rooms, 'rooms');
    }

    /**
     * Get room detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $room = Repository::getRoom()->getRoomDetail([], RoomEnum::COLUMNS_SELECT);
        if (!$room) {
            return null;
        }

        return $room;
    }
}
