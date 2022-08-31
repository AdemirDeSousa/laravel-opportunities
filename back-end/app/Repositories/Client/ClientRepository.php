<?php

namespace App\Repositories\Client;

use App\Models\Client\Client;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function verifyClientExists(int $clientId): void
    {
        if(!$client = Client::query()->find($clientId)){
            throw new NotFoundHttpException('Cliente não encontrado');
        }
    }
}
