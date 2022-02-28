<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserController;

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
// 1|aPvb1WCXBQ6JZsgTXSwurmtztSpkQuCSBrV40P4z


// Route::get('users',function(Request $request){

//     return User::all();
// });
// Route::resource('users',UserController::class);

Route::get('users',[UserController::class,'index']);
Route::get('users/{id}',[UserController::class,'show']);
Route::delete('users/{id}',[UserController::class,'destroy']);



Route::get('products',[ProductController::class,'index'])->middleware('auth:sanctum');
Route::get('products/{id}',[ProductController::class,'show'])->middleware('auth:sanctum');
Route::delete('products/{id}',[ProductController::class,'destroy'])->middleware('auth:sanctum');
 

Route::get('categories',[CategoryController::class,'index'])->middleware('auth:sanctum');
Route::get('categories/{id}',[CategoryController::class,'show'])->middleware('auth:sanctum');
Route::delete('categories/{id}',[CategoryController::class,'destroy'])->middleware('auth:sanctum');



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile', [UserController::class, 'getdata'])->middleware('auth:sanctum');
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/users/{id}', [UserController::class, 'hello']);



// Route::post('/sanctum/token', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//         'device_name' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (! $user || ! Hash::check($request->password, $user->password)) {
//         throw ValidationException::withMessages([
//             'email' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     return $user->createToken($request->device_name)->plainTextToken;
// });

