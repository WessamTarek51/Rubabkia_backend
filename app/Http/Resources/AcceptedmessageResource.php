<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AcceptedmessageResource extends JsonResource
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
        return [
            'id'=>$this->id,
            'buyer_id'=>$this->buyer_id,
            'seller_id'=>$this->seller_id,
            'seller_name'=>$user->name,
            'buyer_name'=>$buyer->name,
            'productimage'=>$this->productimage,
            'productname'=>$this->productname,
            'message'=>$this->message

            // 'name'=>$this->buyer->name,
            // 'id'=>auth()->user->buyer_id,
        ];
    }
}
