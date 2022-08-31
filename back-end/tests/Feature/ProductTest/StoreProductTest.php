<?php

namespace Tests\Feature\ProductTest;

use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_create_a_product_successfully()
    {
        $this->withoutExceptionHandling();

        $payload = ['title' => 'Computador'];

        $this->postJson(route('api.products.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => 'Produto criado com sucesso'
            ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Computador',
        ]);
    }

    /** @test */
    public function fields_must_be_present()
    {
        $this->postJson(route('api.products.store'), [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'title' => [
                        __('validation.required', ['attribute' => 'title'])
                    ],
                ]
            ]);
    }
}
