<?php

namespace App\Http\Requests\Api\Opportunity;

use App\Http\Requests\Api\BaseApiRequest;

class UpdateOpportunityRequest extends BaseApiRequest
{
    protected string $message = 'Falha ao cadastrar oportunidade';

    public function rules()
    {
        return [
            'title' => 'required',
            'client_id' => 'required',
            'product_id' => 'required',
            'status' => 'required|in:1,2,3'
        ];
    }
}
