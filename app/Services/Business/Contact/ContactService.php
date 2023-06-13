<?php

namespace App\Services\Business\Contact;

use App\Enum\ContactEnum;
use App\Helpers\PaginationHelper;
use App\Models\Contact;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class ContactService extends BasesBusiness implements ContactServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
        $this->repository = Repository::getContact();
    }

    /**
     * List all contacts.
     *
     * @param array $condition
     * @return array
     */
    public function getListByAdmin(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $contacts = Repository::getContact()->getListByAdmin($condition, ContactEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($contacts, 'contacts');
    }
}
