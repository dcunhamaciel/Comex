<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use App\Models\Product;
use App\Enums\FlowEnum;
use App\Enums\TransportEnum;

class ComexFactory extends Factory
{
    public function definition(): array
    {
        return [
            'country_id' => Country::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'flow' => fake()->randomElement(FlowEnum::cases()),
            'transport' => fake()->randomElement(TransportEnum::cases()),
            'year' => fake()->year(),
            'month' => fake()->month(),
            'weight' => fake()->randomFloat(4, 1, 10000),
            'amount' => fake()->randomFloat(2, 1, 20000),
        ];
    }
}
