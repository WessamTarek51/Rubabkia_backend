<?php

namespace App\Http\Controllers;
use  App\Models\Purchase;
use  App\Models\Product;
use  App\Models\Sales;
use  App\Models\Acceptedmessage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePurchasesRequest;
use App\Http\Resources\PurchasesResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
class PurchasesController extends Controller
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
    public function store(StorePurchasesRequest $request ,$id)
    {

        $notifi=Notification::find($id);
     /////////////////add in purchases/////////////
     $Purchase=new Purchase();
    $Purchase->name=$notifi->product->name;
    $Purchase->price=$notifi->product->price;
    $Purchase->user_id=$notifi->buyer_id;
    $Purchase->description=$notifi->product->description;
    $Purchase->image=$notifi->product->image;
    $Purchase->save();
        /////////////////add in sales/////////////
    $sales=new Sales();
    $sales->name=$notifi->product->name;
    $sales->price=$notifi->product->price;
    $sales->user_id=$notifi->seller_id;
    $sales->description=$notifi->product->description;
    $sales->image=$notifi->product->image;
    $sales->save();
   
    //////////////////////////// send accept message
    $notifi= Notification::find($id);
    $buyer_id=Notification::select('buyer_id')->where('id',$id)->first();
    $product_id=Notification::select('product_id')->where('id',$id)->first();
    $product_name=Product::select('name')->where('id',$product_id->product_id)->first();
    $product_image=Product::select('image')->where('id',$product_id->product_id)->first();
    $msg=new Acceptedmessage();
    $msg->seller_id=auth()->user()->id;
    $msg->buyer_id=$buyer_id->buyer_id;
    
    $msg->productname=$product_name->name;
    $msg->productimage=$product_image->image;
    $msg->message="Congratulations product become yours enjoy!";
    $msg->save();
    

    ////////////////////////////delete product
     DB::table('favproducts')->where('product_id',$notifi->product->id)->delete();
     DB::table('notifications')->where('product_id',$notifi->product->id)->delete();
     return Product::destroy($notifi->product->id);
     return response()->json(['status'=>1,'message'=>'message sent','code'=>200,'data'=>$msg]);
     return 'purchases ok';



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
        return Notification::destroy($id);

    }
}
