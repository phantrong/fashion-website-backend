<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait ModelTrait
{
  public function getFillable()
  {
    return Arr::prepend($this->fillable, 'id');
  }

  public function getFillableTableName(): array
  {
    $columns = Arr::prepend($this->fillable, 'id');
    $data = [];
    foreach ($columns as $column) {
      $data[] = $this->table . ".$column";
    }
    return $data;
  }

  public function getFillableTimestramp()
  {
    return Arr::collapse([$this->fillable, ['id', 'created_at', 'updated_at']]);
  }

  public static function getTableName()
  {
    return with(new static)->table;
  }
}
