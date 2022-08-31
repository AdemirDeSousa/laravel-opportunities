<?php

namespace App\Repositories\Contracts\Seller;

use App\Models\Seller\Seller;

interface SellerRepositoryInterface
{
    public function storeSeller(array $data): Seller;
}
