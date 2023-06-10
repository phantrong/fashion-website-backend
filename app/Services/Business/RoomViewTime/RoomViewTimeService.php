<?php

namespace App\Services\Business\RoomViewTime;

use App\Models\RoomViewTime;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class RoomViewTimeService extends BasesBusiness implements RoomViewTimeServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(RoomViewTime $roomViewTime)
    {
        $this->model = $roomViewTime;
        $this->repository = Repository::getRoomViewTime();
    }

    public function addViewTime(array $data)
    {
        return $this->repository->addViewTime($data);
    }

    public function getTotalViewTimesByRoomId(int $roomId, string $startTime = null, string $endTime = null)
    {
        return $this->repository->getTotalViewTimesByRoomId($roomId, $startTime, $endTime);
    }

    public function getHistoryArrayRoomIdsByUserId($userId, $customerId = null)
    {
        return $this->repository->getHistoryArrayRoomIdsByUserId($userId, $customerId);
    }
}
