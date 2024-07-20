<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\FlowEnum;
use App\Enums\TransportEnum;

class Comex extends Model
{
    use HasFactory;

    protected $table = 'comex';

    protected $casts = [
        'flow' => FlowEnum::class,
        'transport' => TransportEnum::class,
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
