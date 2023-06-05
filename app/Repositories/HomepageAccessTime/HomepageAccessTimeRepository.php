<?php

namespace App\Repositories\HomepageAccessTime;

use App\Enum\CommonEnum;
use App\Models\HomepageAccessTime;
use App\Repositories\Base\BaseRepository;

class HomepageAccessTimeRepository extends BaseRepository implements HomepageAccessTimeRepositoryInterface
{
    /**
     * HomepageAccessTimeRepository constructor.
     *
     * @param HomepageAccessTime $homepageAccessTime
     */
    public function __construct(HomepageAccessTime $homepageAccessTime)
    {
        parent::__construct($homepageAccessTime);
    }

    public function addAccessTime(array $data)
    {
        if (!@$data['address_ip'] || !@$data['user_agent']) return;

        $record = $this->model->where('address_ip', $data['address_ip'])
            ->where('user_agent', $data['user_agent'])
            ->orderByDesc('created_at')
            ->first();

        if (
            $record &&
            getNow()->subMinutes(CommonEnum::ACCESS_VIEW_DISTANCE_TIME_MINUTE) < getTimeParse($record->created_at)
        ) {
            return;
        }

        return $this->model->create($data);
    }

    public function getTotalAccessTimes(string $startTime = null, string $endTime = null)
    {
        return $this->model
            ->when($startTime && $endTime, function ($query) use ($startTime, $endTime) {
                $query->whereDate('created_at', '>=', $startTime)
                    ->whereDate('created_at', '<=', $endTime);
            })
            ->when(!$startTime && $endTime, function ($query) use ($endTime) {
                $query->whereDate('created_at', '<=', $endTime);
            })
            ->when($startTime && !$endTime, function ($query) use ($startTime) {
                $query->whereDate('created_at', '>=', $startTime);
            })
            ->count();
    }
}
