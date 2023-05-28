<?php

namespace App\Services\Business\Verify;

use App\Models\Verify;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class VerifyService extends BasesBusiness implements VerifyServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Verify $verify)
    {
        $this->model = $verify;
        $this->repository = Repository::getVerify();
    }

    public function createOrUpdate($data)
    {
        return $this->repository->createOrUpdate($data);
    }

    public function getVerifyByCode($code, $columns = ['*'], $conditions = [])
    {
        return $this->repository->createOrUpdate($code, $columns, $conditions);
    }
}
