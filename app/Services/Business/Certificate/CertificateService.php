<?php

namespace App\Services\Business\Certificate;

use App\Enum\CertificateEnum;
use App\Helpers\PaginationHelper;
use App\Repositories\Repository;

class CertificateService implements CertificateServiceInterface
{
    /**
     * Get list of certificates
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $certificates = Repository::getCertificate()->getCertificateListPagination(
            $condition,
            CertificateEnum::COLUMNS_SELECT
        );

        return PaginationHelper::formatPagination($certificates, 'certificates');
    }
}
