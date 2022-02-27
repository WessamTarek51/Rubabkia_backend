<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
// use App\Models\User;
// use App\Models\Product;
// use App\Models\Category;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('users',function(Request $request){

//     return User::all();
// });
// Route::resource('users',UserController::class);

Route::get('users',[UserController::class,'index']);
Route::get('users/{id}',[UserController::class,'show']);
Route::delete('users/{id}',[UserController::class,'destroy']);



Route::get('products',[ProductController::class,'index']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::delete('products/{id}',[ProductController::class,'destroy']);

// Route::resource('products',ProductController::class);


// Route::resource('categories',CategoryController::class);
Route::get('categories',[CategoryController::class,'index']);
Route::get('categories/{id}',[CategoryController::class,'show']);
Route::delete('categories/{id}',[CategoryController::class,'destroy']);

// Route::get('products',function(Request $request){
  
//     return Product::all();
// });

// Route::get('categories',function(Request $request){
   
//     return Category::all();
// });

