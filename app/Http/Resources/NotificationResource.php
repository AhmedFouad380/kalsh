<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'notifiable_type' => $this->notifiable_type,
            'notifiable_id' => $this->notifiable_id,
            'order_id' => $this->order_id,
            'offer_id' => $this->offer_id,
            'offer' => $this->offer ? OfferResource::make($this->offer) : null,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
