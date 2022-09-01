<?php

namespace Tests\Feature\OpportunityTest;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreOpportunityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_create_a_opportunity_successfully()
    {
        $client = Client::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'title' => 'Oportunidade de testes',
            'client_id' => $client->id,
            'product_id' => $product->id,
        ];

        $this->postJson(route('api.opportunities.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => 'Oportunidade criada com sucesso'
            ]);

        $this->assertDatabaseHas('opportunities', [
            'title' => 'Oportunidade de testes',
            'client_id' => 1,
            'product_id' => 1,
            'seller_id' => auth('api-sellers')->user()->id,
            'status' => 1
        ]);
    }

    /** @test */
    public function fields_must_be_present()
    {
        $this->postJson(route('api.opportunities.store'), [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'title' => [
                        __('validation.required', ['attribute' => 'title'])
                    ],
                    'client_id' => [
                        __('validation.required', ['attribute' => 'client id'])
                    ],
                    'product_id' => [
                        __('validation.required', ['attribute' => 'product id'])
                    ],
                ]
            ]);
    }
}
