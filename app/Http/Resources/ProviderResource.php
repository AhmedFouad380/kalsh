<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    protected $token;

    public function token($value)
    {
        $this->token = $value;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_complete = $this->name && $this->email ? true : false;
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'phone' => (string) $this->phone,
            'email' => (string) $this->email,
            'image' => (string) $this->image,
            'rate' => (string) $this->rate,
            'online' => $this->online,
            'lat' => (string) $this->lat,
            'lng' => (string) $this->lng,
            'device_token' => (string) $this->device_token,
            'is_complete' => $is_complete,
            'token' => $this->token,
        ];
    }
}
