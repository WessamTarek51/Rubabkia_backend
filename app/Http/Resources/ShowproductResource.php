<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowproductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      /*   $data=DB::table('Products')
->join('cats','cats.id','products.cat_id')
->where('products.cat_id',$cat_id)
->get(); */

        return [
           'user-name'=>$this->user->name,
            'product-name'=>$this->name,
            'product-price'=>$this->price,
            'product-description'=>$this->description,
            'product-image'=>$this->image
           
         


           

 
        ];
    }
}



 