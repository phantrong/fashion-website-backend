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

    public function getListByUserId($userId, $customerId = null)
    {
        return $this->repository->getListByUserId($userId, $customerId);
    }
}
