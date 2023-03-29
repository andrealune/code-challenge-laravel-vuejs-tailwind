<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
           'first_name' => $this->first_name,
           'last_name' => $this->last_name,
           'phone' => $this->phone,
           'email' => $this->email,
           'created_at'  => $this->created_at->format('d M Y, H:i a'),
           'updated_at'  => $this->updated_at->format('d M Y, H:i a')
        ];
    }
}
