<?php

namespace App\Services\Business\Verify;

interface VerifyServiceInterface
{
    /**
     *
     * @param  array $data
     * @return void
     */
    public function createOrUpdate($data);

    /**
     *
     * @param  string $code
     * @param  array $columns
     * @param  array $conditions
     * @return Model
     */
    public function getVerifyByCode($code, $columns = ['*'], $conditions = []);
}
