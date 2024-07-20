<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    private const PRODUCT_COUNT = 400;

    public function run(): void
    {
        $productCount = Product::count();
        if ($productCount === 0) {
            Product::factory(self::PRODUCT_COUNT)->create();
        }
    }
}
