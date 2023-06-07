<?php

namespace App\Services\Business\InterestedRoom;

use App\Models\InterestedRoom;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class InterestedRoomService extends BasesBusiness implements InterestedRoomServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(InterestedRoom $interestedRoom)
    {
        $this->model = $interestedRoom;
        $this->repository = Repository::getInterestedRoom();
    }

    public function getInterestedRoomsByUserId($userId, $customerId = null)
    {
        return $this->repository->getInterestedRoomsByUserId($userId, $customerId);
    }
}
