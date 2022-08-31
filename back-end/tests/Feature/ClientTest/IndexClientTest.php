<?php

namespace Tests\Feature\ClientTest;

use App\Http\Resources\Client\ClientsResource;
use App\Models\Client\Client;
use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $seller = Seller::factory()->create();

        $this->actingAs($seller, 'api-sellers');
    }

    /** @test */
    public function it_should_return_a_clients_list_successfully()
    {
        $this->withoutExceptionHandling();

        Client::factory()->create();

        $this->getJson(route('api.clients.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    [
                        "name",
                        "email"
                    ]
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_empty_data_successfully()
    {
        $this->withoutExceptionHandling();

        $this->getJson(route('api.clients.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => []
            ]);

    }
}
