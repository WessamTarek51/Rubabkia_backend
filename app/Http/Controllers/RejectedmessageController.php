<?php

namespace App\Http\Controllers;
use  App\Models\Purchase;
use  App\Models\Product;
use  App\Models\Sales;
use  App\Models\Rejectedmessage;
use App\Models\Notification;
use App\Http\Resources\RejectedmessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RejectedmessageController extends Controller
{
    public function store($id){
        $notifi= Notification::find($id);
        $buyer_id=Notification::select('buyer_id')->where('id',$id)->first();
        
        $product=Notification::select('product_id')->where('id',$id)->first();
        
        $product_name=Product::select('name')->where('id',$product->product_id)->first();
        
        $product_image=Product::select('image')->where('id',$product->product_id)->first();
        $msg=new Rejectedmessage();
        $msg->seller_id=auth()->user()->id;
        $msg->buyer_id=$buyer_id->buyer_id;
      
        $msg->productname=$product_name->name;
        $msg->productimage=$product_image->image;
        $msg->message="Sorry! your request has been rejected";
        
        $msg->save();

        DB::table('notifications')->where('product_id',$notifi->product->id)->delete();
    }

    public function show()
    {
        $buyer = auth()->user()->id;
        $product = Rejectedmessage::select ('*')->where('buyer_id',$buyer)->get();
        return RejectedmessageResource::collection($product);
    }

    public function destroy($id)
    {
        return Rejectedmessage::destroy($id);
    }
}
