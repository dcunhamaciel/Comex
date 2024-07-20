<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ncm' => $this->generateNcm(),
            'description' => fake()->word(),
            'specification' => fake()->text(1000),
        ];
    }

    private function generateNcm(): string
    {
        $chapter = $this->generateNumber(1, 99, 2);
        $position = $this->generateNumber(1, 99, 2);
        $subposition = $this->generateNumber(1, 99, 2);
        $item = $this->generateNumber(1, 9, 1);
        $subitem = $this->generateNumber(1, 9, 1);

        $ncm = $chapter . $position . '.' . $subposition . '.' . $item . $subitem;

        return $ncm;
    }

    private function generateNumber(int $min, int $max, int $length): string
    {
        $number = fake()->numberBetween($min, $max);
        $numberStr = str_pad($number, $length, '0', STR_PAD_LEFT);

        return $numberStr;
    }
}
