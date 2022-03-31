<?php
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AcceptedmessageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RejectedmessageController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\UsermessageController;
use App\Http\Controllers\AdminmessageController;
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



Route::get('users',[UserController::class,'index'])->middleware('auth:sanctum');
Route::get('users/{id}',[UserController::class,'show']);
Route::get('user/{id}',[UserController::class,'UserByID']);
Route::delete('users/{id}',[UserController::class,'destroy'])->middleware('auth:sanctum');
Route::post('userbyId',[UserController::class,'getuserbyID']);
Route::post('editProfile',[UserController::class,'editProfile'])->middleware('auth:sanctum');
Route::get('like/{id}',[UserController::class,'like'])->middleware('auth:sanctum');
Route::get('showlike/{id}',[ProductController::class,'showlikeproduct'])->middleware('auth:sanctum');







Route::get('products',[ProductController::class,'index'])->middleware('auth:sanctum');
Route::get('productsWithOutLogin',[ProductController::class,'productsWithOutLogin']);

// Route::get('products/{id}',[ProductController::class,'show'])->middleware('auth:sanctum');
Route::get('product/{catID}',[ProductController::class,'showcat']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::delete('products/{id}',[ProductController::class,'destroy']);
Route::delete('deleteproduct/{id}',[ProductController::class,'delete'])->middleware('auth:sanctum');
Route::delete('favdelete/{id}',[ProductController::class,'favdelete'])->middleware('auth:sanctum');





Route::get('categories',[CategoryController::class,'index']);
Route::post('categories',[CategoryController::class,'store']);
Route::get('categories/{id}',[CategoryController::class,'show']);
// Route::delete('categories/{id}',[CategoryController::class,'destroy'])->middleware('auth:sanctum');
Route::delete('categories/{id}',[CategoryController::class,'destroy']);

Route::post("/products",[ProductController::class,'store'])->middleware('auth:sanctum');

Route::post("/purchases/{id}",[PurchasesController::class,'store'])->middleware('auth:sanctum');
Route::delete("/nof/{id}",[PurchasesController::class,'destroy'])->middleware('auth:sanctum');

Route::post("image/{id}",[ProductController::class,'updateImage'])->middleware('auth:sanctum');
Route::post("fav",[ProductController::class,'AddFav'])->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile', [UserController::class, 'getdata'])->middleware('auth:sanctum');
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/isFav/{product_id}', [UserController::class, 'isFav'])->middleware('auth:sanctum');


Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');
Route::post('/forget', [ForgetPasswordController::class, 'forget']);
Route::post('/reset', [ForgetPasswordController::class, 'reset']);

Route::get('/oo/{id}', [UserController::class, 'hello']);
//Route show detailes of product
Route::get('productid/{id}', [ProductController::class, 'ShowDetailesProduct']);

Route::post("/buy/{id}",[NotificationController::class,'store'])->middleware('auth:sanctum');
Route::get("notification/{id}",[NotificationController::class,'notifay'])->middleware('auth:sanctum');

Route::post("accept/{id}",[AcceptedmessageController::class,'store'])->middleware('auth:sanctum');
Route::get("acceptedmessages",[AcceptedmessageController::class,'show'])->middleware('auth:sanctum');
Route::delete("/acceptedmessages/{id}",[AcceptedmessageController::class,'destroy'])->middleware('auth:sanctum');

Route::post("reject/{id}",[RejectedmessageController::class,'store'])->middleware('auth:sanctum');
Route::get("rejectedmessages",[RejectedmessageController::class,'show'])->middleware('auth:sanctum');
Route::delete("/rejectedmessages/{id}",[RejectedmessageController::class,'destroy'])->middleware('auth:sanctum');


Route::post("feedbacks/{id}",[FeedbackController::class,'store'])->middleware('auth:sanctum');
Route::get("feedbacksdata/{id}",[FeedbackController::class,'index']);
// Route::get("feedbacksdata",[FeedbackController::class,'getall']);
Route::get('governorates',[GovernorateController::class,'index']);
Route::post('governorates',[GovernorateController::class,'store']);
Route::post("usermessages",[UsermessageController::class,'store'])->middleware('auth:sanctum');
Route::get("usermessages",[UsermessageController::class,'index'])->middleware('auth:sanctum');;
Route::post("adminmessages/{id}",[AdminmessageController::class,'store'])->middleware('auth:sanctum');
