<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ComexSeeder::class);
    }
}
