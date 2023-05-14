<?php

namespace App\Repositories\Certificate;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CertificateRepositoryInterface
{
    /**
     * Get list of certificates with pagination.
     *
     * @param array $condition
     * @param $columns
     * @return LengthAwarePaginator
     */
    public function getCertificateListPagination(array $condition, $columns = ['*']);
}
