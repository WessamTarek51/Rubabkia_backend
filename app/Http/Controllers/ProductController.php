<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        $prosucts = Product::all();
        return ProductResource::collection($prosucts);
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
    public function store(StoreProductRequest $request)
    {
        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
       $product->user_id=1;
        $product->description=$request->description;
         $product->category_id =$request->category_id;

         if($request->hasFile('image')){
            $complateName=$request->file('image')->getClientOriginalName();
             $NameOnly=pathinfo($complateName,PATHINFO_FILENAME);
             $ExtensionName=$request->file('image')->getClientOriginalExtension();
             $compPic=str_replace('','',$NameOnly).'.'.$ExtensionName;
             $path=$request->file('image')->storeAs('public/products',$compPic);
             $product->image=$compPic;
         }


        $product->save();
        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Product::find($id);
        $prosucts = Product::find($id);
        if($prosucts){
        return new ProductResource($prosucts);
        }else{
        return "no data to this product";
        }

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
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
                  return response()->json(['message' => 'Not Found'],404);
        }
        else{
                $product->update($request->all());
                 return response($product,200);
        }

    //     $product= Product::find($id);
    //     $product->name=$request->name;
    //     $product->price=$request->price;
    //    $product->user_id=Auth::id();
    //     $product->description=$request->description;
    //      $product->category_id =$request->category_id;
    //     $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);

    }
}
