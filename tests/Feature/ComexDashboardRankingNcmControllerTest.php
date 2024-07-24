<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Country;
use App\Models\Product;
use App\Models\Comex;
use App\Enums\DashboardEnum;

class ComexDashboardRankingNcmControllerTest extends TestCase
{
    use RefreshDatabase;

    private Collection $comexCollection;

    private const ROUTE_INDEX = 'comex-dashboard-ranking-ncm';
    private const PRODUCT_RECORD_COUNT = 20;
    private const COMEX_RECORD_COUNT = 50;

    public function setUp(): void
    {
        parent::setUp();

        Country::factory()->create();
        Product::factory(self::PRODUCT_RECORD_COUNT)->create();

        $this->comexCollection = Comex::factory(self::COMEX_RECORD_COUNT)->create();
    }

    public function testIndexReturnsSuccessfully(): void
    {
        $response = $this->postJson(route(self::ROUTE_INDEX));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testIndexReturnsCorrectRankingNcmData(): void
    {
        $rankingByNcm = $this->calculateRankingByNcm();
        $rankingByNcmCount = $rankingByNcm->count();
        $firstNcm = $rankingByNcm->keys()->first();
        $firstNcmAmount = $rankingByNcm->first();

        $responseJsonItemsCount = min(DashboardEnum::QUANTITY_ITEMS_RANKING->value, $rankingByNcmCount);

        $response = $this->postJson(route(self::ROUTE_INDEX));

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has($responseJsonItemsCount)
        );

        $response
            ->assertJsonFragment(
                [
                    'ncm' => $firstNcm,
                    'amount' => number_format($firstNcmAmount, 2, '.', ''),
                ]
            );
    }

    private function calculateRankingByNcm(): SupportCollection
    {
        $ncmRanking = $this->comexCollection->groupBy('product.ncm')->map(function ($comex) {
            return $comex->sum('amount');
        });

        $ncmRankingSorted = $ncmRanking->sortDesc();

        return $ncmRankingSorted;
    }
}
