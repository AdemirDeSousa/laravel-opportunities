<?php

namespace App\Services\Seller;

use App\Repositories\Contracts\Seller\SellerRepositoryInterface;

class SellerService
{
    protected SellerRepositoryInterface $sellerRepo;

    public function __construct(SellerRepositoryInterface $sellerRepo)
    {
        $this->sellerRepo = $sellerRepo;
    }

    public function store(array $data): void
    {
        $this->sellerRepo->storeSeller($data);
    }
}
