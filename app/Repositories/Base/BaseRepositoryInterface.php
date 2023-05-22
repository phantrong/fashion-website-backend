<?php

namespace App\Repositories\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Get list of models.
     *
     * @param array $condition
     * @param $columns
     * @return Builder[]|Collection
     */
    public function getList(array $condition = [], $columns = ['*']);

    /**
     * Get list of models with pagination.
     *
     * @param array $condition
     * @param $columns
     * @return LengthAwarePaginator
     */
    public function getListPagination(array $condition = [], $columns = ['*']);

    /**
     * Get the model detail.
     *
     * @param array $condition
     * @param $columns
     * @return Model
     */
    public function getDetail(array $condition, $columns = ['*']);

    /**
     * Check existent model.
     *
     * @param array $condition
     * @return bool
     */
    public function exists(array $condition);

    /**
     * Count list of models.
     *
     * @param array $condition
     * @return bool
     */
    public function count(array $condition);

    /**
     * Create model.
     *
     * @param array $values
     * @return Model
     */
    public function create(array $values);

    /**
     * Insert model.
     *
     * @param array $values
     * @return bool
     */
    public function insert(array $values);

    /**
     * Insert model with apply automatically created_at field and updated_at field.
     *
     * @param array $values
     * @return bool
     */
    public function insertTimestamp(array $values);

    /**
     * Update model.
     *
     * @param array $condition
     * @param array $values
     * @return int
     */
    public function update(array $condition, array $values);

    /**
     * Update with model.
     *
     * @param Model $model
     * @param array $input
     * @return Model
     */
    public function updateWithModel(Model $model, array $input);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return Builder|Model
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * Insert new records or update the existing ones.
     *
     * @param array $values
     * @param array|string $uniqueBy
     * @param array $update
     * @return int
     */
    public function upsert(array $values, $uniqueBy, $update = null);

    /**
     * Delete model.
     *
     * @param array $condition
     * @return mixed
     */
    public function delete(array $condition);

    /**
     * find
     *
     * @param  int $id
     * @return object
     */
    public function find($id);

    /**
     * getModel
     *
     * @return mixed
     */
    public function getModel();
}
