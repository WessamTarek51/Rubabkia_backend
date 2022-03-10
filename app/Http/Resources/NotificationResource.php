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
            'id'=>$this->buyer_id,
            'username'=>$user,
            'image'=>$this->product->image,
            'name'=>$this->product->name,


            // 'name'=>$this->buyer->name,
            // 'id'=>auth()->user->buyer_id,
        ];
    }
}
