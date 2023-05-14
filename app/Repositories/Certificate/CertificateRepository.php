<?php

namespace App\Repositories\Certificate;

use App\Models\Certificate;
use App\Repositories\Base\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CertificateRepository extends BaseRepository implements CertificateRepositoryInterface
{
    /**
     * CertificateRepository constructor.
     *
     * @param Certificate $certificate
     */
    public function __construct(Certificate $certificate)
    {
        parent::__construct($certificate);
    }

    /**
     * Get list of certificates with pagination.
     *
     * @param array $condition
     * @param $columns
     * @return LengthAwarePaginator
     */
    public function getCertificateListPagination(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)
            ->when(@$condition['invalid_year_not_null'], function (Builder $query) {
                $query->whereNotNull("{$this->modelTable}.invalid_year");
            })
            ->paginate($condition['per_page'], $columns, 'page', $condition['page']);
    }
}
