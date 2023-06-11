<?php

namespace App\Repositories\HistorySearchKeyWord;

use App\Models\HistorySearchKeyWord;
use App\Repositories\Base\BaseRepository;

class HistorySearchKeyWordRepository extends BaseRepository implements HistorySearchKeyWordRepositoryInterface
{
    /**
     * HistorySearchKeyWordRepository constructor.
     *
     * @param HistorySearchKeyWord $historySearchKeyWord
     */
    public function __construct(HistorySearchKeyWord $historySearchKeyWord)
    {
        parent::__construct($historySearchKeyWord);
    }

    public function getListByUserId($userId, $customerId = null)
    {
        return $this->model->select('id', 'key_word')
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($customerId, function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->orderByDesc('created_at')
            ->limit(5)->get();
    }
}
