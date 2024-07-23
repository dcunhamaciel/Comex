<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Country;
use App\Models\Product;
use App\Models\Comex;
use App\Enums\PaginationEnum;
use App\Enums\FlowEnum;
use App\Enums\TransportEnum;

class ComexListControllerTest extends TestCase
{
    use RefreshDatabase;

    private Country $country;
    private Product $product;
    private Collection $comexCollection;

    private const ROUTE_INDEX = 'comex-list';
    private const CURRENT_PAGE = 1;
    private const RECORD_COUNT = 5;

    public function setUp(): void
    {
        parent::setUp();

        $this->country = Country::factory()->create();
        $this->product = Product::factory()->create();
        $this->comexCollection = Comex::factory(self::RECORD_COUNT)->create();
    }

    public function testIndexReturnsComexList(): void
    {
        $response = $this
            ->postJson(route(self::ROUTE_INDEX));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(
                [
                    'current_page' => self::CURRENT_PAGE,
                    'per_page' => PaginationEnum::DEFAULT_ITEMS_PER_PAGE,
                    'total' => self::RECORD_COUNT,
                ]
            );
    }

    public function testIndexReturnsCorrectComexData(): void
    {
        $firstComex = $this->comexCollection->first();

        $response = $this
            ->postJson(route(self::ROUTE_INDEX));

        $response
            ->assertJsonFragment(
                [
                    'country' => $firstComex->country->description,
                    'product' => $firstComex->product->description,
                    'flow' => FlowEnum::getText($firstComex->flow),
                    'transport' => TransportEnum::getText($firstComex->transport),
                    'year' => intval($firstComex->year),
                    'month' => intval($firstComex->month),
                    'weight' => strval($firstComex->weight),
                    'amount' => strval($firstComex->amount)
                ]
            );
    }
}
