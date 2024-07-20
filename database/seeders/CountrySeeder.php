<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    private const COUNTRY_COUNT = 40;

    public function run(): void
    {
        $countryCount = Country::count();
        if ($countryCount === 0) {
            Country::factory(self::COUNTRY_COUNT)->create();
        }
    }
}
