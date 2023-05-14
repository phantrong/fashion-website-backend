<?php

namespace App\Repositories\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    protected string $modelTable;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelTable = $model->getTable();
    }

    /**
     * Get list of models.
     *
     * @param array $condition
     * @param $columns
     * @return Builder[]|Collection
     */
    public function getList(array $condition = [], $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->get();
    }

    /**
     * Get list of models with pagination.
     *
     * @param array $condition
     * @param $columns
     * @return LengthAwarePaginator
     */
    public function getListPagination(array $condition = [], $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)
            ->paginate($condition['per_page'], $columns, 'page', $condition['page']);
    }

    /**
     * Get the model detail.
     *
     * @param array $condition
     * @param $columns
     * @return Model
     */
    public function getDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }

    /**
     * Check existent model.
     *
     * @param array $condition
     * @return bool
     */
    public function exists(array $condition)
    {
        return $this->query($condition)->exists();
    }

    /**
     * Count list of models.
     *
     * @param array $condition
     * @return bool
     */
    public function count(array $condition)
    {
        return $this->query($condition)->count('id');
    }

    /**
     * Create model.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->newQuery()->create($attributes);
    }

    /**
     * Insert model.
     *
     * @param array $values
     * @return bool
     */
    public function insert(array $values)
    {
        return $this->model->newQuery()->insert($values);
    }

    /**
     * Insert model with apply automatically created_at field and updated_at field.
     *
     * @param array $values
     * @return bool
     */
    public function insertTimestamp(array $values)
    {
        return $this->model->newQuery()->insertTimestamp($values);
    }

    /**
     * Update model.
     *
     * @param array $condition
     * @param array $values
     * @return int
     */
    public function update(array $condition, array $values)
    {
        return $this->query($condition)->update($values);
    }

    /**
     * Update with model.
     *
     * @param Model $model
     * @param array $input
     * @return Model
     */
    public function updateWithModel(Model $model, array $input)
    {
        foreach ($input as $attribute => $value) {
            $model->{$attribute} = $value;
        }
        $model->save();

        return $model;
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return Builder|Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->newQuery()->updateOrCreate($attributes, $values);
    }

    /**
     * Insert new records or update the existing ones.
     *
     * @param array $values
     * @param array|string $uniqueBy
     * @param array $update
     * @return int
     */
    public function upsert(array $values, $uniqueBy, $update = null)
    {
        return $this->model->newQuery()->upsert($values, $uniqueBy, $update);
    }

    /**
     * Delete model.
     *
     * @param array $condition
     * @return mixed
     */
    public function delete(array $condition)
    {
        return $this->query($condition)->delete();
    }

    /**
     * Querying the model.
     *
     * @param array $condition
     * @return Builder
     */
    protected function query(array $condition)
    {
        $query = $this->model->newQuery();
        $this->whereClause($query, $condition);

        return $query;
    }

    /**
     * Set the columns to be selected.
     *
     * @param array $condition
     * @param $columns
     * @return Builder
     */
    protected function querySelect(array $condition, $columns)
    {
        return $this->query($condition)->select($columns);
    }

    /**
     * Add "where" clause to the query.
     *
     * @param Builder $query
     * @param array $condition
     * @return Builder
     */
    protected function whereClause(Builder $query, array $condition)
    {
        foreach ($condition as $column => $value) {
            if (Schema::hasColumn($this->model->getTable(), $column)) {
                $method = !is_array($value) ? 'where' : 'whereIn';
                $query->{$method}($column, $value);
            }
        }

        return $query;
    }
}
