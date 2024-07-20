<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Library\QueryBuilder;
use App\Models\Comex;
use App\DTOs\ComexFilterDto;
use App\Enums\PaginationEnum;

class ComexService
{
    private Comex $comex;

    public function __construct()
    {
        $this->comex = new Comex();
    }

    public function findAll(ComexFilterDto $comexFilterDto): LengthAwarePaginator
    {
        $queryBuilder = new QueryBuilder($this->comex);

        $comexList = $queryBuilder
            ->addEqualFilter('country_id', $comexFilterDto->countryId)
            ->addEqualFilter('flow', $comexFilterDto->flow)
            ->addEqualFilter('transport', $comexFilterDto->transport)
            ->addGreaterThanOrEqualFilter('year', $comexFilterDto->yearFrom)
            ->addLessThanOrEqualFilter('year', $comexFilterDto->yearTo)
            ->addGreaterThanOrEqualFilter('amount', $comexFilterDto->amountFrom)
            ->addLessThanOrEqualFilter('amount', $comexFilterDto->amountTo)
            ->addOrderByDesc('year')
            ->addOrderByDesc('month')
            ->addOrderByAsc('id')
            ->build()
            ->paginate(PaginationEnum::DEFAULT_ITEMS_PER_PAGE->value);

        return $comexList;
    }
}
