<?php

namespace App\Services\Business\Contact;

interface ContactServiceInterface
{
    /**
     * getListByAdmin
     *
     * @param  array $condition
     * @return object
     */
    public function getListByAdmin(array $condition);
}
