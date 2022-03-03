<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class ForgetPasswordController extends Controller
{
    public function forget(Request $request){
       $this->validate($request,[
        'email' => 'required|string|email|max:255',

       ]);
       $email = $request['email'];
       $user=User::where('email', $email)->first();
       if(!$user){
           return response()->json(['message'=>'Email Does not exists.','code'=>401,'status'=>0]);
       }
       $token = Str::random(10);

       DB::table('password_resets')->insert([
           'email' => $email,
           'token' => $token,
           'created_at' => now()->addHours(6)
       ]);

       // Send Mail
       Mail::send('mail.password_reset', ['token'=>$token], function ($message) use($email){
           $message->to($email);
           $message->subject('Reset Your Password');
       });

       return response()->json(['message' => 'Check your email.','code'=>200,'status'=>1]);
    }

    public function reset(Request $request){
        $this->validate($request, [
            'token' => 'required|string',
            'password' => 'required|string',
        ]);

        $token = $request->token;
        $passwordRest = DB::table('password_resets')->where('token', $token)->first();

        // Verify
        if(!$passwordRest){
            return response()->json(['message' => 'Token Not Found.','code'=>401,'status'=>0]);
        }

        // Validate exipire time
        if(!$passwordRest->created_at >= now()){
            return response()->json(['message' => 'Token has expired.','code'=>401,'status'=>2]);
        }

        $user = User::where('email', $passwordRest->email)->first();

        if(!$user){
            return response()->json(['message' => 'User does not exists.','code'=>401,'status'=>0]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('token', $token)->delete();;

        return response()->json(['message'=>'Password Successfully Updated.','code'=>200,'status'=>1]);
    }


}
