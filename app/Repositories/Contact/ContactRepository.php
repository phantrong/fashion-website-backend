<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\Base\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    /**
     * ContactRepository constructor.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        parent::__construct($contact);
    }

    public function getListByAdmin(array $condition, $columns = ['*'])
    {
        return $this->model->select($columns)
            ->when(@$condition['key_word'], function ($query) use ($condition) {
                $query->where(function ($query) use ($condition) {
                    $query->orWhere('name', 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere('email', 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere('content', 'like', '%' . $condition['key_word'] . '%');
                });
            })
            ->paginate($condition['per_page'], $columns, 'page', $condition['page']);
    }
}
