<?php

namespace App\Helpers;

use App\Enum\CommonEnum;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationHelper
{
    /**
     * Get pagination input.
     *
     * @param array $condition
     * @param int $defaultPerPage
     * @return array
     */
    public static function getPaginationInput(array $condition, int $defaultPerPage = CommonEnum::DEFAULT_PER_PAGE)
    {
        $perPage = (isset($condition['per_page']) && is_numeric($condition['per_page'])) ?
            $condition['per_page'] :
            $defaultPerPage;
        $page = (isset($condition['page']) && is_numeric($condition['page'])) ?
            $condition['page'] :
            CommonEnum::DEFAULT_PAGE;

        return [
            $perPage,
            $page,
        ];
    }

    /**
     * Format pagination.
     *
     * @param LengthAwarePaginator $pagination
     * @param string $responseKey
     * @return array
     */
    public static function formatPagination(LengthAwarePaginator $pagination, string $responseKey)
    {
        return [
            'total' => $pagination->total(),
            'per_page' => $pagination->perPage(),
            'page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            $responseKey => $pagination->items(),
        ];
    }

    /**
     * Create pagination.
     *
     * @param $items
     * @param int $perPage
     * @param $page
     * @param int $totalInput
     * @return LengthAwarePaginator
     */
    public static function createPagination(
        $items,
        $perPage = CommonEnum::DEFAULT_PER_PAGE,
        $page = null,
        ?int $totalInput = null
    ) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: CommonEnum::DEFAULT_PAGE);
        $total = $totalInput ?: count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage;
        $items = array_slice($items, $offset, $perPage);

        return new LengthAwarePaginator($items, $total, $perPage, $page);
    }
}
