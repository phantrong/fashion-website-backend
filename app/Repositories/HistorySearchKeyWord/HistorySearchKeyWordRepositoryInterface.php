<?php

namespace App\Repositories\HistorySearchKeyWord;

interface HistorySearchKeyWordRepositoryInterface
{
    /**
     * createOrUpdate
     *
     * @param  string $keyWord
     * @param  object $userId
     * @param  string $customerId
     * @return void
     */
    public function createOrUpdate($keyWord, $userId, $customerId = null);

    /**
     * getListByUserId
     *
     * @param  int $userId
     * @param  string $customerId
     * @return object
     */
    public function getListByUserId($userId, $customerId = null);
}
