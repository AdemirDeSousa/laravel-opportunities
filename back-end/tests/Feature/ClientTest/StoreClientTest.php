<?php

namespace Tests\Feature\ClientTest;

use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_create_a_client_successfully()
    {
        $payload = [
            'name' => 'Kleber',
            'email' => 'cliente@gmail.com',
        ];

        $this->postJson(route('api.clients.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => 'Cliente criado com sucesso'
            ]);

        $this->assertDatabaseHas('clients', [
            'name' => 'Kleber',
            'email' => 'cliente@gmail.com',
        ]);
    }

    /** @test */
    public function fields_must_be_present()
    {
        $this->postJson(route('api.clients.store'), [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'email' => [
                        __('validation.required', ['attribute' => 'email'])
                    ],
                    'name' => [
                        __('validation.required', ['attribute' => 'name'])
                    ],
                ]
            ]);
    }
}
