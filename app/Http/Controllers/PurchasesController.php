<?php

namespace App\Http\Controllers;
use  App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\StorePurchasesRequest;
use App\Http\Resources\PurchasesResource;
use Illuminate\Support\Facades\Auth;

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
    public function store(StorePurchasesRequest $request)
    {
  //
  $Purchase=new Purchase();


    $Purchase->name=$request->name;
    $Purchase->price=$request->price;
     $Purchase->user_id=Auth()->user()->id;
    $Purchase->description=$request->description;
     $Purchase->image=$request->image;
       $Purchase->save();

//      if($request->hasFile('image')){
//         $complateName=$request->file('image')->getClientOriginalName();
//          $NameOnly=pathinfo($complateName,PATHINFO_FILENAME);
//          $ExtensionName=$request->file('image')->getClientOriginalExtension();
//          $compPic=str_replace('','',$NameOnly).'.'.$ExtensionName;
//          $path=$request->file('image')->move('public/products',$compPic);
//          $product->image=$compPic;
//      }
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
        //
    }
}
