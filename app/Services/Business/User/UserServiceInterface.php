<?php

namespace App\Services\Business\User;

use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    /**
     * Create token.
     *
     * @param array $input
     * @return string
     */
    public function createToken(array $input);

    /**
     * List all users.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition);

    /**
     * Get user detail.
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

    /**
     * getUserByEmail
     *
     * @param  string $email
     * @param  array $columns
     * @return object
     */
    public function getUserByEmail($email, $columns);
}
