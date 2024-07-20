<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Interfaces\ApiRequestDto;

readonly class ComexFilterDto implements ApiRequestDto
{
    public function __construct(
        public int $countryId,
        public string $flow,
        public string $transport,
        public int $yearFrom,
        public int $yearTo,
        public float $amountFrom,
        public float $amountTo
    ) {
    }

    public static function fromApiRequest(Request $request): self
    {
        return new self(
            $request->validated('countryId') ?? 0,
            $request->validated('flow') ?? '',
            $request->validated('transport') ?? '',
            $request->validated('year.from') ?? 0,
            $request->validated('year.to') ?? 0,
            $request->validated('amount.from') ?? 0.00,
            $request->validated('amount.to') ?? 0.00
        );
    }
}
