<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiKeyResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'server_id' => $this->server_id,
            'key' => $this->key,
            'key_type' => $this->key_type,
            'token' => $this->token,
            'client_ip' => $this->client_ip,
            'server_ip' => $this->server_ip,
            'status' => $this->status,
            'server_info' => $this->server_info,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
