<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Acceptedmessage;
use App\Http\Resources\AcceptedmessageResource;
class AcceptedmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
    public function store(Request $request,$id)
    {
        // $notifi= Notification::find($id);
        // $buyer_id=Notification::select('buyer_id')->where('id',$id)->first();
        // $product_id=Notification::select('product_id')->where('id',$id)->first();
        // $product_name=Product::select('name')->where('id',$product_id)->first();
        // $product_image=Product::select('image')->where('id',$product_id)->first();
        // $msg=new Acceptedmessage();
        // $msg->seller_id=auth()->user()->id;
        // $msg->buyer_id=$buyer_id->buyer_id;
        // $msg->productname=$product_name;
        // $msg->productimage=$product_image;
        // $msg->message="Congratulations product become yours enjoy!";
        // $msg->save();
        // return response()->json(['status'=>1,'message'=>'message sent','code'=>200,'data'=>$msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $buyer = auth()->user()->id;
        $product = Acceptedmessage::select ('*')->where('buyer_id',$buyer)->get();
        return  AcceptedmessageResource::collection($product);
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
        return Acceptedmessage::destroy($id);
    }
}
