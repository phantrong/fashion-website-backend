<?php

namespace App\Services\Business;

class BasesBusiness
{
    protected $model;
    protected $repository;

    public function getModel()
    {
        return $this->model;
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function insert($data)
    {
        return $this->repository->insert($data);
    }

    public function update($conditions, $data)
    {
        return $this->repository->update($conditions, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
