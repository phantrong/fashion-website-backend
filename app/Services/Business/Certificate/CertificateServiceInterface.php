<?php

namespace App\Services\Business\Certificate;

interface CertificateServiceInterface
{
    /**
     * Get list of certificates
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);
}
