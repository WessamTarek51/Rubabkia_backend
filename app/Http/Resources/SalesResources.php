<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class SalesResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user=User::select('name')->where('id',$this->user_id)->first();

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'image'=>$this->image,
            'description'=>$this->description,
            'user_id'=>$this->user_id,
            'username'=>$user->name,
            

            // 'user_name'=>$this->user()->name,

        ];
    }
}
