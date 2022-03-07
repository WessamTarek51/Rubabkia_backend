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
            'userid'=>$this->user->id,
            'username'=>$this->user->name,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'image'=>$this->image







        ];
    }
}



