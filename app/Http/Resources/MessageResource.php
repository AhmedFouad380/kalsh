<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'sender_id' => $this->sender_id,
            'sender_name'=>$this->sender_name,
            'sender_type'=>$this->sender_type,
            'voice'=>$this->voice,
            'is_read'=>$this->is_read,
            'created_at'=>\Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
