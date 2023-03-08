<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliverySerivceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => (string)$this->name,
            'commission' => (double)$this->commission,
            'min_cost' => (double)$this->min_cost,
            'kilo_cost' => (double)$this->kilo_cost,
            'min_distance' => (double)$this->min_distance,
            'range_shop' => (integer)$this->range_shop,
            'range_provider' => (integer)$this->range_provider,
            'range_provider_to_shop' => (integer)$this->range_provider_to_shop,
            'type' => (string)$this->type,
            'image' => (string)$this->image,
        ];
    }
}
