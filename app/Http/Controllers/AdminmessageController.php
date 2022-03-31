<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Usermessage;
use App\Models\Adminmessage;
use App\Http\Resources\AdminmessageResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminmessageController extends Controller
{
    public function store(Request $request,$id)
    {
        $adminmessage=new Adminmessage();
        $adminmessage->message=$request->message;
        $adminmessage->admin_id=auth()->user()->id;
        $user=Usermessage::select('user_id')->where('id',$id)->first();
        $adminmessage->user_id=$user->user_id;
        $adminmessage->save();
        DB::table('usermessages')->where('id',$id)->delete();
        return $adminmessage;
        }

        public function index()
        {
            $admin = Adminmessage::select('*')->where('user_id',auth()->user()->id)->get();
            return AdminmessageResource::collection($admin);
        }
}
