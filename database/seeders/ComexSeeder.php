<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comex;

class ComexSeeder extends Seeder
{
    private const COMEX_COUNT = 4000;

    public function run(): void
    {
        $comexCount = Comex::count();
        if ($comexCount === 0) {
            Comex::factory(self::COMEX_COUNT)->create();
        }
    }
}
