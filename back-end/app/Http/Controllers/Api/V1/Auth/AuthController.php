<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\Seller\SellerService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    public function login(LoginRequest $request)
    {
        try {

            if (!$token = auth('api-sellers')->attempt($request->validated())) {
                return response()->json([
                    'error' => 'Unauthorized'
                ], 401);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api-sellers')->factory()->getTTL() * 60,
            ]);

        } catch (\Exception $e) {

            Log::info('Falha ao realizar login', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao realizar login'
            ], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {

            $this->sellerService->store($request->validated());

            return response()->json([
                'message' => 'Vendedor criado com sucesso',
            ], 201);

        } catch (\Exception $e) {

            Log::info('Falha ao cadastrar vendedor', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao cadastrar vendedor'
            ], 500);

        }
    }
}

