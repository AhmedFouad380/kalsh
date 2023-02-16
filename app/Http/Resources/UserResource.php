<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
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
            'lat' => (string) $this->lat,
            'lng' => (string) $this->lng,
            'lang' => (string) $this->lang,
            'device_token' => (string) $this->device_token,
            'is_complete' => $is_complete,
            'token' => (string)$this->token,
        ];
    }
}
