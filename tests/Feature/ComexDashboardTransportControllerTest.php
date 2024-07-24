<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Country;
use App\Models\Product;
use App\Models\Comex;
use App\Enums\TransportEnum;

class ComexDashboardTransportControllerTest extends TestCase
{
    use RefreshDatabase;

    private Collection $comexCollection;

    private const ROUTE_INDEX = 'comex-dashboard-transport';
    private const RECORD_COUNT = 20;

    public function setUp(): void
    {
        parent::setUp();

        Country::factory()->create();
        Product::factory()->create();

        $this->comexCollection = Comex::factory(self::RECORD_COUNT)->create();
    }

    public function testIndexReturnsSuccessfully(): void
    {
        $response = $this->postJson(route(self::ROUTE_INDEX));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testIndexReturnsCorrectTransportData(): void
    {
        $amountByTransport = $this->calculateAmountByTransport();
        $amountByTransportCount = count($amountByTransport);
        $firstTransport = $amountByTransport[0];

        $response = $this->postJson(route(self::ROUTE_INDEX));

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has($amountByTransportCount)
        );

        $response
            ->assertJsonFragment(
                [
                    'transport' => $firstTransport['transport'],
                    'amount' => strval($firstTransport['amount']),
                ]
            );
    }

    private function calculateAmountByTransport(): array
    {
        $totalTransportAmount = [];

        foreach (TransportEnum::cases() as $transportEnum) {
            $transportComex = $this->filterTransportType($transportEnum);
            $transportAmount = $transportComex->sum('amount');

            if ($transportAmount > 0) {
                array_push($totalTransportAmount,
                    [
                        'transport' => $transportEnum->value,
                        'amount' => $transportAmount
                    ]);
            }
        }

        return $totalTransportAmount;
    }

    private function filterTransportType(TransportEnum $transportEnum): Collection
    {
        $transportFiltered = $this->comexCollection->filter(function (Comex $comex, int $key) use ($transportEnum) {
            return $comex->transport === $transportEnum;
        });

        return $transportFiltered;
    }
}
