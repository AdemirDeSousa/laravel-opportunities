<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\BaseApiRequest;

class StoreProductRequest extends BaseApiRequest
{
    protected string $message = 'Falha ao cadastrar produto';

    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }
}
