<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Uuid.
 * Manages the usage of creating UUID values for primary keys. Drop into your models as
 * per normal to use this functionality. Works right out of the box.
 */
trait UuidForKey
{
    /**
     * The "booting" method of the model.
     */
    public static function bootUuidForKey()
    {
        static::retrieved(function (Model $model) {
            $model->incrementing = false;
        });
        static::creating(function (Model $model) {
            $model->incrementing = false;
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }

    /**
     * Initialize UUID for key.
     */
    public function initializeUuidForKey()
    {
        $this->keyType = 'string';
    }
}
