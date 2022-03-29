<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;
use SebastianBergmann\Environment\Console;
use App\Http\Resources\UserIdRessource;
use App\Models\Favproduct as Favorite;
use App\Http\Resources\ProductResource;
use App\Models\Product;


class UserController extends Controller
{
    protected $cid;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  //register

    public function register(Request $request)
    {

      $validatedData = $request->validate([
                   'name' => 'required|string|max:255',
                   'email' => 'required|string|email|max:255',
                   'password' => 'required|string|min:8',
                   'phone_number' => ' required|digits:11',
                   'image'=>'required',
                   'address'=>'required|string',
                   'gender'=>'required',
                   'governorate_id'=>'required'
              ]);
     $user = User::where('email', $request['email'])->first();
     if($user){
        return response()->json([
               'status'=>0,
               'message'=>'email has already been taken',
               'code'=>422
        ]);
       }
    else{
        if($request->hasFile('image')){

            $completeimagename=$request->file('image')->getClientOriginalName();
            $imagename=pathinfo($completeimagename,PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $compic=str_replace(' ','_',$imagename).'-'.rand().'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images',$compic);
        }
      $user = User::create([
                   'name' => $validatedData['name'],
                   'email' => $validatedData['email'],
                   'phone_number'=>$validatedData['phone_number'],
                   'address'=>$validatedData['address'],
                   'image'=>$compic,
                   'password' => Hash::make($validatedData['password']),
                   'governorate_id'=>$validatedData['governorate_id'],
                   'gender'=>$validatedData['gender'],
                   'is_admin'=>$request->is_admin
       ]);


       $token = $user->createToken('auth_token')->plainTextToken;
                 return response()->json([
                //    'access_token' => $token,
                //    'token_type' => 'Bearer',
                    'status'=>1,
                   'message'=>'regestered successfuly',
                   'code'=>200
            ]);
        }
          }

//login
    public function login(Request $request)
          {
          if (!Auth::attempt($request->only('email', 'password'))) {
          return response()->json([
          'message' => 'Invalid login details',
          'status'=>0,
          'code'=>401
                     ]);
                 }

          $user = User::where('email', $request['email'])->firstOrFail();

          $token = $user->createToken('auth_token')->plainTextToken;

          return response()->json([
                     'access_token' => $token,
                     'token_type' => 'Bearer',
                     'status'=>1,
                     'message'=>'login successfully',
                     'code'=>200,
                     'id'=>auth()->user()->id,
                     'name'=>auth()->user()->name,
                     'is_admin'=>auth()->user()->is_admin

          ]);
          }

          public function logout(Request $request){
              auth('sanctum')->user()->tokens()->delete();
              return response()->json([
                'message' => 'logged out',

     ]);
          }
          public function getdata(Request $request)
          {
            return new UserResource($request);

        //   return $request->user()->name;
          }

    public function index()
    {
        // $users = User::all()->except($currentUser->id);
        $users = User::select("*")->where('is_admin',null)->get();
        return UserIdRessource::collection($users);
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
    public function store(Request $request)
    {
        // $user=new User();
        // $user->name=$request->name;
        // $user->email=$request->email;
        // $user->password=$request->password;
        // $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find(Auth::user()->id));
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
    //    return User::destroy($id);
    DB::table('feedbacks')->where('buyer_id',$id)->delete();
    DB::table('feedbacks')->where('seller_id',$id)->delete();
    DB::table('purchases')->where('user_id',$id)->delete();
    DB::table('sales')->where('user_id',$id)->delete();
    DB::table('users')->where('id',$id)->delete();
    }

    public function hello($id)
    {
        return new UserResource(User::find($id));
 }

    public function editProfile(Request $request){
try{
    $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
                'phone_number' => 'required|digits:11',
                'image'=>'required',
                'address'=>'required|string',
                'gender'=>'required'
           ]);
           if($request->hasFile('image')){

            $completeimagename=$request->file('image')->getClientOriginalName();
            $imagename=pathinfo($completeimagename,PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $compic=str_replace(' ','_',$imagename).'-'.rand().'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images',$compic);
        }

               $user=User::find($request->user()->id);
               $user->name = $request->name;
               $user->email = $request->email;
               $user->address = $request->address;
               $user->password = Hash::make($request->password);
               $user->phone_number = $request->phone_number;
               $user->governorate_id=$request->governorate_id;
               $user->image = $compic;
               $user->gender=$request->gender;
               $user->update();
            return response()->json(['status'=>1,'message'=>'profile updated','code'=>200,'data'=>$user]);

    }
    catch(\Exception $e){
        return response()->json(['status'=>0,'message'=>$e->getMessage(),'data'=>[],'code'=>500]);
       }
    }


    public function getuserbyID(Request $request){
        $users = User::whereIn('id', $request->id)->get();

        return $users;

    }
    public function UserByID($id)
    {
        return new UserIdRessource(User::find($id));

    }

    public function like($product_id){
    // $this->cid = auth()->guard('user')->user()->id;
    $cid=auth()->user()->id;
    if(!Favorite::where(['product_id'=>$product_id,'user_id'=>$cid])->exists()){
        Favorite::create(['product_id'=>$product_id,'user_id'=>$cid]);


    }
    $product = Product::find($product_id);
    return new ProductResource($product);

}
    public function isFav($product_id,Request $request){
       if(  Favorite::where('user_id',auth()->user()->id)->where('product_id',$product_id)->exists()){
        return "true";
       }
       else{
           return "false";
       }

    }
}

