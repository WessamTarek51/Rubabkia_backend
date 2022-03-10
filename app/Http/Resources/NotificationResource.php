<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user=User::select('name')->where('id',$this->buyer_id)->first();
        return [
            'id_not'=>$this->id,
            'user_id'=>$this->buyer_id,
            'buyer_name'=>$user->name,
            'image'=>$this->product->image,
            'price'=>$this->product->price,
            'description'=>$this->product->description,
            'name'=>$this->product->name,


            // 'name'=>$this->buyer->name,
            // 'id'=>auth()->user->buyer_id,
        ];
    }
}
