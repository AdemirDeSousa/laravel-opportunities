<?php

namespace App\Http\Resources\Opportunity;

use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'client_id' => $this->client_id,
            'product_id' => $this->product_id,
            'status' => $this->status
        ];
    }
}
