<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderFormResource extends JsonResource
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
        return [
            'id' => (int) $this->id,
            'image' => (string) $this->image,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'city_id' => (int) $this->city_id,
            'id_image' => (string) $this->id_image,
            'driving_license_image' => (string) $this->driving_license_image,
            'undermining_image' => (string) $this->undermining_image,
            'insurance_image' => (string) $this->insurance_image,
            'service_id' => (int) $this->service_id,
        ];
    }
}
