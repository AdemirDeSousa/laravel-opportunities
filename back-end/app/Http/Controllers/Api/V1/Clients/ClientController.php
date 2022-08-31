<?php

namespace App\Http\Controllers\Api\V1\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\StoreClientRequest;
use App\Services\Client\ClientService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        return $this->clientService->index();
    }

    public function store(StoreClientRequest $request)
    {
        try {

            $this->clientService->store($request->validated());

            return response()->json([
                'message' => 'Cliente criado com sucesso'
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {

            Log::info('Falha ao cadastrar cliente', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao cadastrar cliente'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}

