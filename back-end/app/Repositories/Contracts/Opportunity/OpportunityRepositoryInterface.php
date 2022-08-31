<?php

namespace App\Repositories\Contracts\Opportunity;

use App\Models\Opportunity\Opportunity;
use Illuminate\Support\Collection;

interface OpportunityRepositoryInterface
{
    public function getOpportunities(): Collection;

    public function storeOpportunity(array $data, int $sellerId): Opportunity;
}
