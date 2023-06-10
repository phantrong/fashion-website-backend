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

    public function getListByAdmin(array $condition = [])
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $rooms = $this->repository->getListByAdmin($condition);

        return PaginationHelper::formatPagination($rooms, 'rooms');
    }

    public function getDetailByAdmin($id, array $condition = [])
    {
        return $this->repository->getDetailByAdmin($id, $condition);
    }

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param int $id
     * @return Model
     */
    public function getDetail($condition, $id)
    {
        $room = Repository::getRoom()->getRoomDetail($condition, RoomEnum::COLUMNS_SELECT);
        if (!$room) {
            return null;
        }

        return $room;
    }

    public function getListSearchByUser(array $condition = [])
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $rooms = $this->repository->getListSearchByUser($condition);

        return PaginationHelper::formatPagination($rooms, 'rooms');
    }

    public function getDetailByUser($id, array $condition = [])
    {
        return $this->repository->getDetailByUser($id, $condition);
    }

    public function getCountRoomInHanoi($condition = [])
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $rooms = $this->repository->getCountRoomInHanoi($condition);

        return PaginationHelper::formatPagination($rooms, 'rooms');
    }
}
