<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            // 'username'=>auth()->user()->name,
            // 'image'=>auth()->user()->image,
            // 'phoneNUmber'=>auth()->user()->phone_number,
            // 'myproduct'=>auth()->user()->products,
            'id'=>$this->id,
            'username'=>$this->name,
            'image'=>$this->image,
            'email'=>$this->email,
            'phoneNumber'=>$this->phone_number,
            'address'=>$this->address,
            'password'=>$this->password,
            'products' =>$this->products
           

            ];
    }
}
