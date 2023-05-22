<?php

namespace App\Services\Business\Admin;

use Illuminate\Database\Eloquent\Model;

interface AdminServiceInterface
{
    /**
     * Create token.
     *
     * @param array $input
     * @return string
     */
    public function createToken(array $input);

    /**
     * List all admins.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get admin detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id);

    /**
     * Destroy token.
     *
     * @param string $token
     */
    public function destroyToken(string $token);
}
