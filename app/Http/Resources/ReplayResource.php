<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ReplayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user=User::select('name')->where('id',$this->seller_id)->first();
        $buyer=User::select('name')->where('id',$this->buyer_id)->first();
        $image=User::select('image')->where('id',$this->seller_id)->first();
        return [
            'id'=>$this->id,
            'buyer_id'=>$this->buyer_id,
            'seller_id'=>$this->seller_id,
            'seller_name'=>$user->name,
            'buyer_name'=>$buyer->name,
            'image'=>$image->image,
            'message'=>$this->message,
      
        ];
    }
}
