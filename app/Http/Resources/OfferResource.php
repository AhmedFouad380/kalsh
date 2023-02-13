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
            'order_id' => $this->order_id, //user order resource
            'status_id' => $this->status_id, //user order resource
            'order' => (new OrderResource($this->order)), //user order resource
//            'description' => $this->description,
        ];
    }
}
