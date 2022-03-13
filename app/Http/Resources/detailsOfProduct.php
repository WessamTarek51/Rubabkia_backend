<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class detailsOfProduct extends JsonResource
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
            'userid'=>$this->user->id,
            'username'=>$this->user->name,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'image'=>$this->image,

        ];
    }
}
