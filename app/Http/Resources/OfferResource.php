<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'status_id' => $this->status_id,
            'order' => $this->order ? OrderResource::make($this->order) : null,
            'provider' => $this->provider ? ProviderResource::make($this->provider) : null,
            'description' => $this->description,
        ];
    }
}
