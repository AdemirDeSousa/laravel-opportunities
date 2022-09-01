<?php

namespace Tests\Feature\OpportunityTest;

use App\Models\Client\Client;
use App\Models\Opportunity\Opportunity;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexOpportunityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_return_a_opportunities_list_successfully()
    {
        $this->withoutExceptionHandling();

        Client::factory()->create();

        Product::factory()->create();

        Opportunity::factory()->create([
            'client_id' => 1,
            'product_id' => 1
        ]);

        $this->getJson(route('api.opportunities.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'title',
                        'seller',
                        'client',
                        'product',
                        'status',
                        'created_at'
                    ]
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_empty_data_successfully()
    {
        $this->withoutExceptionHandling();

        $this->getJson(route('api.opportunities.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => []
            ]);

    }
}
