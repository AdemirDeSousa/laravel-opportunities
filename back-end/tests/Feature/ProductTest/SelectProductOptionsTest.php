<?php

namespace Tests\Feature\ProductTest;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SelectProductOptionsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_return_a_list_of_clients_options_successfully()
    {
        Product::factory()->count(10)->create();

        $this->getJson(route('api.select-options.products'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'key',
                        'value'
                    ]
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_empty_data_successfully()
    {
        $this->withoutExceptionHandling();

        $this->getJson(route('api.select-options.products'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => []
            ]);

    }
}
