<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
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
                   'email' => 'required|string|email|max:255|unique:users',
                   'password' => 'required|string|min:8',
                   'phone_number' => ' required|digits:11',
                   'address'=>'required|string',
              ]);

      $user = User::create([
                   'name' => $validatedData['name'],
                   'email' => $validatedData['email'],
                   'phone_number'=>$validatedData['phone_number'],
                   'address'=>$validatedData['address'],
                   'image'=>'image',
                   'password' => Hash::make($validatedData['password']),
       ]);


       $token = $user->createToken('auth_token')->plainTextToken;

       return response()->json([
                   'access_token' => $token,
                   'token_type' => 'Bearer',
                   'message'=>'regestered successfuly'
            ]);

          }

//login
    public function login(Request $request)
          {
          if (!Auth::attempt($request->only('email', 'password'))) {
          return response()->json([
          'message' => 'Invalid login details'
                     ], 401);
                 }

          $user = User::where('email', $request['email'])->firstOrFail();

          $token = $user->createToken('auth_token')->plainTextToken;

          return response()->json([
                     'access_token' => $token,
                     'token_type' => 'Bearer',
                     'id'=>auth()->user()->id,
                     'name'=>auth()->user()->name,
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
        //
    }

    public function hello($id)
    {
        return new UserResource(User::find($id));

    }
}
