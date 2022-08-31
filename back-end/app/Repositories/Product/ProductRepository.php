<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $entity;

    public function __construct(Product $products)
    {
        $this->entity = $products;
    }

    public function getProducts(): Collection
    {
        return $this->entity->get();
    }

    public function storeProduct(array $data): Product
    {
        return $this->entity->create([
            'title' => $data['title'],
        ]);
    }

    public function verifyProductExists(int $clientId): void
    {
        if(!$client = $this->entity->query()->find($clientId)){
            throw new NotFoundHttpException('Produto não encontrado');
        }
    }
}
