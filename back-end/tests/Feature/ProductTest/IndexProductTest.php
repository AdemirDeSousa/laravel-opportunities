<?php

namespace Tests\Feature\ProductTest;

use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexProductTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_return_a_products_list_successfully()
    {
        $this->withoutExceptionHandling();

        Product::factory()->create();

        $this->getJson(route('api.products.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'title'
                    ]
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_empty_data_successfully()
    {
        $this->withoutExceptionHandling();

        $this->getJson(route('api.products.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => []
            ]);

    }
}
