<?php

namespace App\Repositories\Opportunity;

use App\Models\Opportunity\Opportunity;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;

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
}
