<?php

namespace App\Http\Resources;

use App\Models\Provider;
use App\Models\ProviderForm;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (auth('provider')->check()) {
            $provider_form = ProviderForm::where('provider_id', auth('provider')->user()->id)->where('service_id', $this->id)->first();
            if ($provider_form) {
                $is_registered = 1;
            } else {
                $is_registered = 0;
            }
        } else {
            $is_registered = 0;
        }
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'image' => (string)$this->image,
            'price' => (string)$this->price,
            'is_registered' => $is_registered,
        ];
    }
}
