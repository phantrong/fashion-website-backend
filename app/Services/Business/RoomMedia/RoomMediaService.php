<?php

namespace App\Services\Business\RoomMedia;

use App\Models\RoomMedia;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class RoomMediaService extends BasesBusiness implements RoomMediaServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(RoomMedia $roomMedia)
    {
        $this->model = $roomMedia;
        $this->repository = Repository::getRoomMedia();
    }

    public function deleteByRoomId($roomId)
    {
        return $this->repository->deleteByRoomId($roomId);
    }
}
