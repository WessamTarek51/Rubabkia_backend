<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json( [
                'status'=>0,
                'message' => 'Already Verified'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => ' Check your email verification-link-sent','status'=>1]);
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status'=>0,
                'message' => 'Email already verified'
            ]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'status'=>1,
            'message'=>'Email has been verified'
        ]);
    }
}
