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
            'id'=>auth()->user()->id,
            'username'=>auth()->user()->name,
            'image'=>auth()->user()->image,
            'email'=>auth()->user()->email,
            'phoneNumber'=>auth()->user()->phone_number,
            'address'=>auth()->user()->address,
            'password'=>auth()->user()->password,
            'products'=>auth()->user()->products,
            'purchases'=>auth()->user()->purchases,
            'sales'=>auth()->user()->sales,

            // 'id'=>$this->id,
            // 'username'=>$this->name,
            // 'image'=>$this->image,
            // 'email'=>$this->email,
            // 'phoneNumber'=>$this->phone_number,
            // 'address'=>$this->address,
            // 'password'=>$this->password,
            // 'products' =>$this->products,
            // 'purchases'=>$this->purchases,
            ];
    }
}
