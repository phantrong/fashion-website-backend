<?php

namespace App\Repositories\UserCertificate;

use App\Models\UserCertificate;
use App\Repositories\Base\BaseRepository;

class UserCertificateRepository extends BaseRepository implements UserCertificateRepositoryInterface
{
    /**
     * UserCertificateRepository constructor.
     *
     * @param UserCertificate $userCertificate
     */
    public function __construct(UserCertificate $userCertificate)
    {
        parent::__construct($userCertificate);
    }
}
