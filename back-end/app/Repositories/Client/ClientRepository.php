<?php

namespace App\Repositories\Client;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use Illuminate\Support\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    protected Client $entity;

    public function __construct(Client $clients)
    {
        $this->entity = $clients;
    }

    public function getClients(): Collection
    {
        return $this->entity->get();
    }

    public function storeClient(array $data): Client
    {
        return $this->entity->create([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}
