<?php

namespace App\Services\Opportunity;

use App\Http\Resources\Opportunity\OpportunitiesResource;
use App\Http\Resources\Opportunity\OpportunityResource;
use App\Models\Seller\Seller;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class OpportunityService
{
    protected OpportunityRepositoryInterface $opportunityRepo;
    protected ClientRepositoryInterface $clientRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(
        OpportunityRepositoryInterface $opportunityRepo,
        ClientRepositoryInterface $clientRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->opportunityRepo = $opportunityRepo;
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRepository;
    }

    public function show(int $id)
    {
        return new OpportunityResource($this->opportunityRepo->findByIdOrFail($id));
    }

    public function index(Request $request)
    {
        return OpportunitiesResource::collection($this->opportunityRepo->getOpportunities($request));
    }

    public function store(array $data): void
    {
        /** @var Seller $seller */
        $seller = auth('api-sellers')->user();

        $this->clientRepository->verifyClientExists($data['client_id']);

        $this->productRepository->verifyProductExists($data['product_id']);

        $this->opportunityRepo->storeOpportunity($data, $seller->id);
    }

    public function update(int $id, array $data)
    {
        $this->clientRepository->verifyClientExists($data['client_id']);

        $this->productRepository->verifyProductExists($data['product_id']);

        $this->opportunityRepo->update($id, $data);
    }
}
