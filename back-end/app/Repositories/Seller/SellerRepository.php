<?php

namespace App\Repositories\Seller;

use App\Models\Seller\Seller;
use App\Repositories\Contracts\Seller\SellerRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class SellerRepository implements SellerRepositoryInterface
{
    protected $entity;

    public function __construct(Seller $sellers)
    {
        $this->entity = $sellers;
    }

    public function storeSeller(array $data): Seller
    {
        return $this->entity->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
