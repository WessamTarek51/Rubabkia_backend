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
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'image'=>$this->image,
            'category_id'=>$this->category_id,
            'category_name'=>$this->category->name,
            'description'=>$this->description,
            'category'=>$this->category_id,


            // 'user-id'=>$this->user->id,
            // 'user-name'=>$this->user->name

        ];
    }
}

