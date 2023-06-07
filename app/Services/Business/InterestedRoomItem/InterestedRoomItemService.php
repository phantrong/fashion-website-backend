<?php

namespace App\Services\Business\InterestedRoomItem;

use App\Helpers\PaginationHelper;
use App\Models\InterestedRoomItem;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class InterestedRoomItemService extends BasesBusiness implements InterestedRoomItemServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(InterestedRoomItem $interestedRoomItem)
    {
        $this->model = $interestedRoomItem;
        $this->repository = Repository::getInterestedRoomItem();
    }

    public function addItem($data)
    {
        return $this->repository->addItem($data);
    }

    public function getListItemByUserId($userId, $customerId = null)
    {
        return $this->repository->getListItemByUserId($userId, $customerId);
    }

    public function getListDetailItemByUserId($userId, $customerId = null, $condition = [])
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $items = $this->repository->getListDetailItemByUserId($userId, $customerId, $condition);

        return PaginationHelper::formatPagination($items, 'items');
    }
}
