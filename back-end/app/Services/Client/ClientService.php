<?php

namespace App\Services\Client;

use App\Http\Resources\Client\ClientsResource;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;

class ClientService
{
    protected ClientRepositoryInterface $clientRepo;

    public function __construct(ClientRepositoryInterface $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function index()
    {
        return ClientsResource::collection($this->clientRepo->getClients());
    }

    public function store(array $data): void
    {
        $this->clientRepo->storeClient($data);
    }
}
