<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
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
        $queryBuilder = $this->addFilters($queryBuilder, $comexFilterDto);

        $comexList = $queryBuilder
            ->addOrderByDesc('year')
            ->addOrderByDesc('month')
            ->addOrderByAsc('id')
            ->build()
            ->paginate(PaginationEnum::DEFAULT_ITEMS_PER_PAGE->value);

        return $comexList;
    }

    public function getTotalByTransport(ComexFilterDto $comexFilterDto): Collection
    {
        $queryBuilder = new QueryBuilder($this->comex);
        $queryBuilder = $this->addFilters($queryBuilder, $comexFilterDto);

        $comexList = $queryBuilder
            ->addSelect('transport')
            ->addSelect('sum(weight) as weight')
            ->addSelect('sum(amount) as amount')
            ->addGroupBy('transport')
            ->build()
            ->get();

        return $comexList;
    }

    private function addFilters(QueryBuilder $queryBuilder, ComexFilterDto $comexFilterDto): QueryBuilder
    {
        $queryBuilder
            ->addEqualFilter('country_id', $comexFilterDto->countryId)
            ->addEqualFilter('flow', $comexFilterDto->flow)
            ->addEqualFilter('transport', $comexFilterDto->transport)
            ->addGreaterThanOrEqualFilter('year', $comexFilterDto->yearFrom)
            ->addLessThanOrEqualFilter('year', $comexFilterDto->yearTo)
            ->addGreaterThanOrEqualFilter('amount', $comexFilterDto->amountFrom)
            ->addLessThanOrEqualFilter('amount', $comexFilterDto->amountTo);

        return $queryBuilder;
    }
}
