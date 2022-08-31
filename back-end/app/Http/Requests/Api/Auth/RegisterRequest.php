<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class RegisterRequest extends BaseApiRequest
{
    protected string $message = 'Falha ao cadastrar vendedor';

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required',
        ];
    }
}
