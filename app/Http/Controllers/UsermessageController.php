<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Usermessage;
use App\Http\Resources\UsermessageResource;
use Illuminate\Http\Request;

class UsermessageController extends Controller
{
    public function store(Request $request)
    {
        $usermessage=new Usermessage();
        $usermessage->message=$request->message;
        $usermessage->user_id=auth()->user()->id;
        $admin=User::select('id')->where('is_admin',1)->first();
        $usermessage->admin_id=$admin->id;
        $usermessage->name=$request->name;
    
        $usermessage->save();
        return $usermessage;
        }

        public function index()
        {
            $admin = Usermessage::select('*')->where('admin_id',auth()->user()->id)->get();
            return UsermessageResource::collection($admin);
        }
}
