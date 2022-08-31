<?php

namespace App\Repositories\Opportunity;

use App\Http\Resources\Opportunity\OpportunitiesResource;
use App\Models\Opportunity\Opportunity;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;
use Illuminate\Support\Collection;

class OpportunityRepository implements OpportunityRepositoryInterface
{
    protected Opportunity $entity;

    public function __construct(Opportunity $opportunities)
    {
        $this->entity = $opportunities;
    }

    public function storeOpportunity(array $data, int $sellerId): Opportunity
    {
        return $this->entity->create([
            'title' => $data['title'],
            'client_id' => $data['client_id'],
            'product_id' => $data['product_id'],
            'seller_id'  => $sellerId,
        ]);
    }

    public function getOpportunities(): Collection
    {
        return $this->entity->query()->get();
    }
}
