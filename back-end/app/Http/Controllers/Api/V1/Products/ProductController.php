<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreProductRequest;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->index();
    }

    public function store(StoreProductRequest $request)
    {
        try {

            $this->productService->store($request->validated());

            return response()->json([
                'message' => 'Produto criado com sucesso'
            ], 201);

        } catch (\Exception $e) {

            Log::info('Falha ao cadastrar produto', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao cadastrar produto'
            ], 500);

        }
    }
}

