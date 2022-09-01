<?php

namespace App\Services\Product;

use App\Http\Resources\Product\ProductOptionsResource;
use App\Http\Resources\Product\ProductsResource;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;

class ProductService
{
    protected ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        return ProductsResource::collection($this->productRepo->getProducts());
    }

    public function selectOptions()
    {
        return ProductOptionsResource::collection($this->productRepo->getProducts());
    }

    public function store(array $data): void
    {
        $this->productRepo->storeProduct($data);
    }
}
