<?php

namespace App\Repositories\Opportunity;

use App\Models\Opportunity\Opportunity;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OpportunityRepository implements OpportunityRepositoryInterface
{
    protected Opportunity $entity;

    public function __construct(Opportunity $opportunities)
    {
        $this->entity = $opportunities;
    }

    public function findByIdOrFail(int $id): Opportunity
    {
        if(!$opportunity = $this->entity->find($id)){
            throw new NotFoundHttpException('Oportunidade não encontrada');
        }

        return $opportunity;
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

    public function update(int $id, array $data): void
    {
        $opportunity = $this->findByIdOrFail($id);

        $opportunity->update([
            'title' => $data['title'],
            'client_id' => $data['client_id'],
            'product_id' => $data['product_id'],
        ]);
    }

    public function getOpportunities(Request $request): Collection
    {
        $query = $this->entity;

        if($request->filled('title')){
            $query = $query->where('title', $request->title);
        }

        return $query->get();
    }
}
