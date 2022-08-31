<?php

namespace App\Http\Requests\Api\Client;

use App\Http\Requests\Api\BaseApiRequest;

class StoreClientRequest extends BaseApiRequest
{
    protected string $message = 'Falha ao cadastrar cliente';

    public function rules()
    {
        return [
            'email' => 'required|email|unique:clients,email',
            'name' => 'required'
        ];
    }
}
