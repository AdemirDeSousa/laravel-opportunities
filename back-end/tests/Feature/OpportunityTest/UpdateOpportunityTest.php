<?php

namespace Tests\Feature\OpportunityTest;

use App\Models\Client\Client;
use App\Models\Opportunity\Opportunity;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateOpportunityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_update_a_opportunity_successfully()
    {
        $this->withoutExceptionHandling();

        Client::factory()->count(2)->create();
        Product::factory()->count(2)->create();

        $opportunity = Opportunity::factory()->create([
            'title' => 'Oportunidade de Testes',
            'client_id' => 1,
            'product_id' => 1
        ]);

        $payload = [
            'title' => 'Oportunidade editada',
            'client_id' => 2,
            'product_id' => 2,
            'status' => 2
        ];

        $this->putJson(route('api.opportunities.update', ['id' => $opportunity->id]), $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Oportunidade atualizada com sucesso'
            ]);

        $this->assertDatabaseHas('opportunities', [
            'title' => 'Oportunidade editada',
            'client_id' => 2,
            'product_id' => 2,
            'status' => 2
        ]);
    }

    /** @test */
    public function fields_must_be_present()
    {
        $this->putJson(route('api.opportunities.update', ['id' => 123]), [])
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
                    'status' => [
                        __('validation.required', ['attribute' => 'status'])
                    ],
                ]
            ]);
    }

    /** @test */
    public function it_should_return_a_not_found_http_exception_if_opportunity_not_found()
    {
        Client::factory()->create();
        Product::factory()->create();

        $payload = [
            'title' => 'Oportunidade editada',
            'client_id' => 1,
            'product_id' => 1,
            'status' => 1
        ];

        $this->putJson(route('api.opportunities.update', ['id' => 123]), $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'Oportunidade não encontrada'
            ]);

    }
}
