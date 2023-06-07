<?php

namespace App\Repositories\InterestedRoomItem;

interface InterestedRoomItemRepositoryInterface
{
    /**
     * addItem
     *
     * @param  array $data
     * @return void
     */
    public function addItem($data);

    /**
     * getListItemByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getListItemByUserId($userId, $customerId = null);

    /**
     * getListDetailItemByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @param  array $condition
     * @return object
     */
    public function getListDetailItemByUserId($userId, $customerId = null, $condition = []);
}
