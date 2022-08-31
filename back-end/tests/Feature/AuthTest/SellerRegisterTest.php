<?php

namespace Tests\Feature\AuthTest;

use App\Models\Seller\Seller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SellerRegisterTest extends TestCase
{
    public const ENCODED_PASSWORD = '$2a$12$IqirdFrTM0w4pF5.yhQKbOpYe2fy.GmzmxHEVb3iVZez5QQPSSjPy';

    /** @test */
    public function should_register_a_seller_successfully()
    {
        Hash::shouldReceive('make')->once()
            ->andReturn(self::ENCODED_PASSWORD);

        $payload = [
            'name' => 'Kleber',
            'email' => 'teste@gmail.com',
            'password' => 'password'
        ];

        $this->postJson(route('api.auth.register'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => 'Vendedor criado com sucesso'
            ]);

        $this->assertDatabaseHas('sellers', [
            'name' => 'Kleber',
            'email' => 'teste@gmail.com',
            'password' => self::ENCODED_PASSWORD
        ]);
    }

    /** @test */
    public function fields_must_be_present()
    {
        $this->postJson(route('api.auth.register'), [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'email' => [
                        __('validation.required', ['attribute' => 'email'])
                    ],
                    'name' => [
                        __('validation.required', ['attribute' => 'name'])
                    ],
                    'password' => [
                        __('validation.required', ['attribute' => 'password'])
                    ]
                ]
            ]);
    }

    /** @test */
    public function field_email_must_be_a_valid_email()
    {
        $this->postJson(route('api.auth.register'), [
            'email' => 'invalid-email'
        ])->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'email' => [
                        __('validation.email', ['attribute' => 'email'])
                    ]
                ]
            ]);
    }

    /** @test */
    public function field_email_must_be_unique()
    {
        Seller::factory()->create([
            'email' => 'teste@gmail.com'
        ]);

        $this->postJson(route('api.auth.register'), [
            'email' => 'teste@gmail.com'
        ])->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'email' => [
                        __('validation.unique', ['attribute' => 'email'])
                    ]
                ]
            ]);
    }
}
