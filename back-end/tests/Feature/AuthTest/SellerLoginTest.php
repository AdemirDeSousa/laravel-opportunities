<?php

namespace Tests\Feature\AuthTest;

use App\Models\Seller\Seller;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SellerLoginTest extends TestCase
{
    /** @test */
    public function should_authenticate_seller_successfully()
    {
        $seller = Seller::factory()->create();

        $payload = [
            'email' => $seller->email,
            'password' => 'password'
        ];

//        $this->actingAs($seller, 'api-sellers');

        $this->postJson(route('api.auth.login'), $payload)
            ->assertJsonStructure([
                'access_token'
            ])->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function field_email_and_password_must_be_present()
    {
        $this->postJson(route('api.auth.login'), [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'data' => [
                    'email' => [
                        __('validation.required', ['attribute' => 'email'])
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
        $this->postJson(route('api.auth.login'), [
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
}
