<?php

namespace App\Repositories\Contracts\Opportunity;

use App\Models\Opportunity\Opportunity;

interface OpportunityRepositoryInterface
{
    public function storeOpportunity(array $data, int $sellerId): Opportunity;
}
