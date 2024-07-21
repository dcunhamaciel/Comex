<?php

namespace App\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class QueryBuilder
{
    private Builder $builder;

    private const EQUAL_OPERATOR = '=';
    private const GREATER_THAN_OR_EQUAL_OPERATOR = '>=';
    private const LESS_THAN_OR_EQUAL_OPERATOR = '<=';

    private const ASC_DIRECTION = 'asc';
    private const DESC_DIRECTION = 'desc';

    public function __construct(Model $model)
    {
        $this->builder = $model->query();
    }

    private function addFilter(string $field, string $operator, int|float|string|null $value): void
    {
        if (!is_null($value)) {
            $this->builder->where($field, $operator, $value);
        }
    }

    public function addEqualFilter(string $field, int|float|string|null $value): self
    {
        $this->addFilter($field, self::EQUAL_OPERATOR, $value);

        return $this;
    }

    public function addGreaterThanOrEqualFilter(string $field, int|float|string|null $value): self
    {
        $this->addFilter($field, self::GREATER_THAN_OR_EQUAL_OPERATOR, $value);

        return $this;
    }

    public function addLessThanOrEqualFilter(string $field, int|float|string|null $value): self
    {
        $this->addFilter($field, self::LESS_THAN_OR_EQUAL_OPERATOR, $value);

        return $this;
    }

    private function addOrderBy(string $field, string $direction): void
    {
        $this->builder->orderBy($field, $direction);
    }

    public function addOrderByAsc(string $field): self
    {
        $this->addOrderBy($field, self::ASC_DIRECTION);

        return $this;
    }

    public function addOrderByDesc(string $field): self
    {
        $this->addOrderBy($field, self::DESC_DIRECTION);

        return $this;
    }

    public function addGroupBy(string $field): self
    {
        $this->builder->groupBy($field);

        return $this;
    }

    public function addSelect(string $expression, array $bindings = [])
    {
        $this->builder->selectRaw($expression, $bindings);

        return $this;
    }

    public function build(): Builder
    {
        return $this->builder;
    }
}
