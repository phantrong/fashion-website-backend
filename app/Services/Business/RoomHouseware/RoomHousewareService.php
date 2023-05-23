<?php

namespace App\Services\Business\RoomHouseware;

use App\Models\RoomHouseware;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class RoomHousewareService extends BasesBusiness implements RoomHousewareServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(RoomHouseware $roomHouseware)
    {
        $this->model = $roomHouseware;
        $this->repository = Repository::getRoomHouseware();
    }

    public function deleteByRoomId($roomId)
    {
        return $this->repository->deleteByRoomId($roomId);
    }
}
