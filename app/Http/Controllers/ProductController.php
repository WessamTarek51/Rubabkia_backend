<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShowproductResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\File;
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
       $product->user_id=$request->user()->id;
        $product->description=$request->description;
         $product->category_id =$request->category_id;


         if($request->hasFile('image')){
            $complateName=$request->file('image')->getClientOriginalName();
             $NameOnly=pathinfo($complateName,PATHINFO_FILENAME);
             $ExtensionName=$request->file('image')->getClientOriginalExtension();
             $compPic=str_replace('','',$NameOnly).'.'.$ExtensionName;
             $path=$request->file('image')->move('public/products',$compPic);
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

    public function ShowDetailesProduct($id)
    {

        return new ShowproductResource(Product::find($id));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
                  return response()->json(['message' => 'Not Found'],404);
        }
        else{
                // $product->update($request->all());
                //  return response($product,200);
                //  $product->save();
                //  return 'ok';



                 if($request->hasFile('image')){

                   $destination='public/products'.$product->image;

                  if(File::exists($destination)){

                      File::delete($destination);

                  }

                    $complateName=$request->file('image')->getClientOriginalName();
                     $NameOnly=pathinfo($complateName,PATHINFO_FILENAME);
                     $ExtensionName=$request->file('image')->getClientOriginalExtension();
                     $compPic=str_replace('','',$NameOnly).'.'.$ExtensionName;
                     $path=$request->file('image')->move('public/products',$compPic);
                     $product->image=$compPic;

                 }

//
                        $product->name=$request->name;
                        $product->price=$request->price;
                        $product->user_id=$request->user()->id;
                        $product->description=$request->description;
                        $product->category_id =$request->category_id;

                $product->update();
                return $product;
 }
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



    public function showcat($catID)
    {
        $id = Product::select('*')->where('category_id',$catID)->get();


        return ProductResource::collection($id);

                    // return $id;
        // $prosucts = Product::all();
    }
}
