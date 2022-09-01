<?php

namespace Tests\Feature\OpportunityTest;

use App\Models\Client\Client;
use App\Models\Opportunity\Opportunity;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowOpportunityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_return_a_opportunities_successfully()
    {
        $this->withoutExceptionHandling();

        Client::factory()->create();

        Product::factory()->create();

        $opportunity = Opportunity::factory()->create([
            'title' => 'Oportunidade de Testes',
            'client_id' => 1,
            'product_id' => 1
        ]);

        $this->getJson(route('api.opportunities.show', ['id' => $opportunity->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'title' => 'Oportunidade de Testes',
                    'client_id' => 1,
                    'product_id' => 1,
                    'status' => 1
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_not_found_htt_exception_if_opportunity_not_found()
    {
        $this->getJson(route('api.opportunities.show', ['id' => 123]))
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'Oportunidade não encontrada'
            ]);

    }
}
