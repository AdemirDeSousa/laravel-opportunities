<?php

namespace App\Services\Opportunity;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function store(array $data): void
    {
        /** @var Seller $seller */
        $seller = auth('api-sellers')->user();

        $this->clientRepository->verifyClientExists($data['client_id']);

        $this->productRepository->verifyProductExists($data['product_id']);

        $this->opportunityRepo->storeOpportunity($data, $seller->id);
    }
}
