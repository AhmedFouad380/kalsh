<?php

namespace App\Http\Resources;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
        $offer = Offer::where('provider_id',Auth::guard('provider')->id())
            ->where('order_id',$this->id)
            ->first();
        return [
            'id' => (int) $this->id,
            'type' => (string) $this->type,
            'user_id' => (int) $this->user_id,
            'user_name' => (string) @optional($this->user)->name,
            'user_image' => (string) @optional($this->user)->image,
            'provider_id' => (int) $this->provider_id,
            'provider_name' => (string) @optional($this->provider)->name,
            'provider_image' => (string) @optional($this->provider)->image,
            'service_id' => (int) $this->service_id,
            'ready_service_id' => (int) $this->ready_service_id,
            'status_id' => (int) $this->status_id,
            'radius' => (string) $this->radius,
            'description' => (string) $this->description,
            'voice' => (string) $this->voice,
            'from_lat' => (string) $this->from_lat,
            'from_lng' => (string) $this->from_lng,
            'to_lat' => (string) $this->to_lat,
            'to_lng' => (string) $this->to_lng,
            'price' => (string) $this->price,
            'payment_type' => (string) $this->payment_type,
            'payment_status' => (string) $this->payment_status,
            'user_rated' => $this->user_rated,
            'provider_rated' => $this->provider_rated,
            'offer_sent' => $offer ? true : false,
            'offer_description' => $offer ? $offer->description : "",
            'created_at' => (string) Carbon::make($this->created_at)->toDateString(),
        ];
    }
}
