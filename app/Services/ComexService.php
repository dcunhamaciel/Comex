<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Comex;
use App\DTOs\ComexFilterDto;
use App\Enums\PaginationEnum;

class ComexService
{
    private const FIELD_YEAR_ORDER = 'year';
    private const FIELD_MONTH_ORDER = 'month';
    private const FIELD_ID_ORDER = 'id';

    private const FIELD_YEAR_DIRECTION_ORDER = 'desc';
    private const FIELD_MONTH_DIRECTION_ORDER = 'desc';
    private const FIELD_ID_DIRECTION_ORDER = 'asc';

    public function findAll(ComexFilterDto $comexFilterDto): LengthAwarePaginator
    {
        $comexList = Comex::orderBy(self::FIELD_YEAR_ORDER, self::FIELD_YEAR_DIRECTION_ORDER)
            ->orderBy(self::FIELD_MONTH_ORDER, self::FIELD_MONTH_DIRECTION_ORDER)
            ->orderBy(self::FIELD_ID_ORDER, self::FIELD_ID_DIRECTION_ORDER)
            ->paginate(PaginationEnum::DEFAULT_ITEMS_PER_PAGE->value);

        return $comexList;
    }
}
