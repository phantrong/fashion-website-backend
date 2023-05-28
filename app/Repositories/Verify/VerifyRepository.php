<?php

namespace App\Repositories\Verify;

use App\Models\Verify;
use App\Repositories\Base\BaseRepository;

class VerifyRepository extends BaseRepository implements VerifyRepositoryInterface
{
    /**
     * VerifyRepository constructor.
     *
     * @param Verify $verify
     */
    public function __construct(Verify $verify)
    {
        parent::__construct($verify);
    }

    public function createOrUpdate($data)
    {
        $verify = $this->model
            ->where('email_phone', $data['email_phone'])
            ->where('type', $data['type'])
            ->where('user_role', $data['user_role'])
            ->first();
        if ($verify) {
            $verify->update(['code_verify' => $data['code_verify']]);
        } else {
            $this->model->create($data);
        }
        return;
    }

    public function getVerifyByCode($code, $columns = ['*'], $condition = [])
    {
        return $this->model
            ->where('code_verify', $code)
            ->when(@$condition['type'], function ($query) use ($condition) {
                return $query->where('type', $condition['type']);
            })
            ->when(@$condition['user_role'], function ($query) use ($condition) {
                return $query->where('user_role', $condition['user_role']);
            })
            ->first($columns);
    }
}
