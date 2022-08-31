<?php

namespace App\Http\Controllers\Api\V1\Opportunities;

use App\Http\Requests\Api\Opportunity\StoreOpportunityRequest;
use App\Models\Opportunity\Opportunity;
use App\Services\Opportunity\OpportunityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OpportunityController
{
    private OpportunityService $opportunityService;

    public function __construct(OpportunityService $opportunityService)
    {
        $this->opportunityService = $opportunityService;
    }

    public function store(StoreOpportunityRequest $request)
    {
        try {

            $this->opportunityService->store($request->validated());

            return response()->json([
                'message' => 'Oportunidade criada com sucesso'
            ], Response::HTTP_CREATED);

        } catch (NotFoundHttpException $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {

            Log::info('Falha ao cadastrar oportunidade', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao cadastrar oportunidade'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}

