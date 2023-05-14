<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class QueryBuilderTimestampProvider extends ServiceProvider
{
    protected static array $methods = [
        'insertTimestamp',
        'updateTimestamp',
    ];

    /**
     * Insert with timestamp.
     *
     * @return void
     */
    protected static function insertTimestamp()
    {
        return static::timestampValues(__FUNCTION__, [
            'method' => 'insert',
            'column' => [
                'created_at',
                'updated_at',
            ],
        ]);
    }

    /**
     * Update with timestamp.
     *
     * @return void
     */
    protected static function updateTimestamp()
    {
        return static::timestampValues(__FUNCTION__, [
            'method' => 'update',
            'column' => [
                'updated_at',
            ],
        ]);
    }

    /**
     * @param $funcName
     * @param array $columns
     */
    protected static function timestampValues($funcName, array $columns)
    {
        Builder::macro($funcName, function (array $values) use ($columns) {
            $values['id'] = Str::uuid();
            foreach ($columns['column'] as $column) {
                $values[$column] = now();
            }

            return Builder::{$columns['method']}($values);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$methods as $method) {
            static::{$method}();
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
