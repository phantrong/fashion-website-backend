<?php

namespace App\Repositories\Contact;

interface ContactRepositoryInterface
{
    /**
     * getListByAdmin
     *
     * @param  array $condition
     * @param  array $columns
     * @return object
     */
    public function getListByAdmin(array $condition, $columns = ['*']);
}
