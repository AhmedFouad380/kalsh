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
            'id' => (int) $this->id,
            'type' => (string) $this->type,
            'notifiable_type' => (string) $this->notifiable_type,
            'notifiable_id' => (int) $this->notifiable_id,
            'order_id' => (int) $this->order_id,
            'offer_id' => (int) $this->offer_id,
            'offer' => $this->offer ? OfferResource::make($this->offer) : null,
            'title' => (string) $this->title,
            'description' => (string) $this->description
        ];
    }
}
