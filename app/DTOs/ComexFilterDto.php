<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Interfaces\ApiRequestDto;

readonly class ComexFilterDto implements ApiRequestDto
{
    public function __construct(
        public ?int $countryId,
        public ?string $flow,
        public ?string $transport,
        public ?int $yearFrom,
        public ?int $yearTo,
        public ?float $amountFrom,
        public ?float $amountTo
    ) {
    }

    public static function fromApiRequest(Request $request): self
    {
        return new self(
            $request->validated('country'),
            $request->validated('flow'),
            $request->validated('transport'),
            $request->validated('year.from'),
            $request->validated('year.to'),
            $request->validated('amount.from'),
            $request->validated('amount.to')
        );
    }
}
