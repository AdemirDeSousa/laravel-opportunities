<?php

namespace App\Repositories\Contracts\Product;

use App\Models\Product\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function getProducts(): Collection;

    public function storeProduct(array $data): Product;

    public function verifyProductExists(int $productId): void;
}
