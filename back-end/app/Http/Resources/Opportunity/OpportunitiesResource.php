<?php

namespace App\Http\Resources\Opportunity;

use Illuminate\Http\Resources\Json\JsonResource;

class OpportunitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'client' => $this->client->name,
            'seller' => $this->seller->name,
            'product' => $this->product->title,
            'status' => $this->status
        ];
    }
}
