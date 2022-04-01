<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminmessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $admin=User::select('name')->where('id',$this->admin_id)->first();
        return [
            'id'=>$this->id,
            'user_id'=>auth()->user()->id,
            'admin_id'=>$this->admin_id,
            'name'=>$admin->name,
             'message'=>$this->message,
            ];
    }
}
