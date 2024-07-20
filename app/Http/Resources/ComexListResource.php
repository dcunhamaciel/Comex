<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\FlowEnum;
use App\Enums\TransportEnum;

class ComexListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'country' => $this->country->description,
            'product' => $this->product->description,
            'flow' => FlowEnum::getText($this->flow),
            'transport' => TransportEnum::getText($this->transport),
            'year' => $this->year,
            'month' => $this->month,
            'weight' => $this->weight,
            'amount' => $this->amount,
        ];
    }
}
