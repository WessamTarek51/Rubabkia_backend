<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            // 'product-id'=>$this->id,
            'product-name'=>$this->name,
            'product-price'=>$this->price,
            'product-image'=>$this->image,
            'user-id'=>$this->user->id,
            'user-name'=>$this->user->name

        ];
    }
}
