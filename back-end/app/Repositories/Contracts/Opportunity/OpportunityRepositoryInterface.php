<?php

namespace App\Repositories\Contracts\Opportunity;

use App\Models\Opportunity\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface OpportunityRepositoryInterface
{
    public function getOpportunities(Request $request): Collection;

    public function storeOpportunity(array $data, int $sellerId): Opportunity;

    public function findByIdOrFail(int $id): Opportunity;

    public function update(int $id, array $data): void;
}
