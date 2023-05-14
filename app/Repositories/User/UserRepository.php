<?php

namespace App\Repositories\User;

use App\Enum\CertificateEnum;
use App\Models\User;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Get user detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getUserDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)
            ->when(@$condition['relate_certificates'], function (Builder $query) {
                $query->with([
                    'certificates' => function (BelongsToMany $query) {
                        $tableUserCertificate = CertificateEnum::TABLE_USER_CERTIFICATE;
                        $query->select([
                            "$tableUserCertificate.id",
                            'name',
                            'expiration_date',
                        ]);
                    },
                ]);
            })
            ->first();
    }
}
