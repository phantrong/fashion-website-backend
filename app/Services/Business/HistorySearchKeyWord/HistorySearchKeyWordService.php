<?php

namespace App\Services\Business\HistorySearchKeyWord;

use App\Models\HistorySearchKeyWord;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class HistorySearchKeyWordService extends BasesBusiness implements HistorySearchKeyWordServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(HistorySearchKeyWord $historySearchKeyWord)
    {
        $this->model = $historySearchKeyWord;
        $this->repository = Repository::getHistorySearchKeyWord();
    }

    public function createOrUpdate($keyWord, $userId, $customerId = null)
    {
        return $this->repository->createOrUpdate($keyWord, $userId, $customerId);
    }

    public function getListByUserId($userId, $customerId = null)
    {
        return $this->repository->getListByUserId($userId, $customerId);
    }
}
