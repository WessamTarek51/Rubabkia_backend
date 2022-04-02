<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Acceptedmessage;
use App\Http\Resources\FeedbackResource;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $feedback = Feedback::select('*')->where('seller_id',$id)->get();


        return FeedbackResource::collection($feedback);
    }

    public function feeduser(Request $request,$id)
    {
        $seller = auth()->user()->id;
        $replays = Feedback::select('*')->where('seller_id',$id)->get();


        return FeedbackResource::collection($replays);
    }
    
    public function allfeeds()
    {
        // return Category::all();
        $feedbacks = Feedback::all();
        return FeedbackResource::collection($feedbacks);

    }
    // public function getall(){
    //     $users = User::all();
    //     return FeedbackResource::collection($feedbacks);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $feedback=new Feedback();
        $feedback->message=$request->message;
       $feedback->buyer_id=auth()->user()->id;
       $seller=Acceptedmessage::select('seller_id')->where('id',$id)->first();
       $feedback->rate=$request->rate;
       $feedback->seller_id=$seller->seller_id;
    //    return $feedback;
        $feedback->save();
        return $feedback;

    //     return response()->json([
    //         'status'=>1,
    //         'message'=>'feedbaaack  sent',
    //         'code'=>200
    //  ]);
        //  return 'ok';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Feedback::destroy($id);
    }
}
