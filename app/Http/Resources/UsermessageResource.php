<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UsermessageResource extends JsonResource
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
        $useremail=User::select('email')->where('id',$this->user_id)->first();
        $image=User::select('image')->where('id',$this->user_id)->first();
        return [
            'id'=>$this->id,
            'admin_id'=>auth()->user()->id,
            'user_id'=>$this->user_id,
            'name'=>$user->name,
            'image'=>$image->image,
            'message'=>$this->message,
            'email'=>$useremail->email,
            ];
    
    }
}
