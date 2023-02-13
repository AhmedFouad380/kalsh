<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user_name' => @optional($this->user)->name,
            'user_image' => @optional($this->user)->image,
            'provider_id' => $this->provider_id,
            'provider_name' => @optional($this->provider)->name,
            'provider_image' => @optional($this->provider)->image,
            'service_id' => $this->service_id,
            'ready_Service_id' => $this->ready_Service_id,
            'status_id' => $this->status_id,
            'radius' => $this->radius,
            'description' => $this->description,
            'voice' => $this->voice,
            'from_lat' => $this->from_lat,
            'from_lng' => $this->from_lng,
            'to_lat' => $this->to_lat,
            'to_lng' => $this->to_lng,
            'price' => $this->price,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'user_rated' => $this->user_rated,
            'provider_rated' => $this->provider_rated,
            'created_at' => Carbon::make($this->created_at)->toDateString(),
        ];
    }
}
