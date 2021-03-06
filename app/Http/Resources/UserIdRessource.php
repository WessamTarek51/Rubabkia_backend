<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIdRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'username'=>$this->name,
            'image'=>$this->image,
            'email'=>$this->email,
            'phoneNumber'=>$this->phone_number,
            'address'=>$this->address,
             'products'=>$this->products
            ];
    }
}
