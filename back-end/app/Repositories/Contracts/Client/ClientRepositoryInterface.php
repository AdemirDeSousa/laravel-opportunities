<?php

namespace App\Repositories\Contracts\Client;

use App\Models\Client\Client;
use Illuminate\Support\Collection;

interface ClientRepositoryInterface
{
    public function getClients(): Collection;

    public function storeClient(array $data): Client;

    public function verifyClientExists(int $clientId): void;
}
