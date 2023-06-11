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

    public function createOrUpdate($keyWord, $userId, $customerId = null)
    {
        $record = $this->model
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($customerId, function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->where('key_word', $keyWord)
            ->first();

        if ($record) {
            $record->delete();
        }

        return $this->model->create([
            'user_id' => $userId,
            'customer_id' => $customerId,
            'key_word' => $keyWord,
        ]);
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
            ->orderByDesc('updated_at')
            ->limit(5)->get();
    }
}
