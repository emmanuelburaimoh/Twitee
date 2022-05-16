<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Validator;

class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api', ['except'=>['login-user', 'register-user']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password'=>bcrypt($request->password)],
            ['name'=>substr($request->email, 0, strrpos($request->email, '@'))]
        ));
        return response()->json([
            'message'=>'User reg successfull',
            'user'=>$user
        ], 201);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }
        if(!$token=auth()->attempt($validator->validated())){
            return response()->json(["error"=>'Unauthorised', 401]);
        }
        return $this->createNewToken($token);
    }
    public function createNewToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
            'user'=>auth()->user()
        ]);
    }
    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout(Request $request){
        $token = $request->header( 'Authorization' );

        try {
            auth()->parseToken()->invalidate( $token );

            return response()->json( [
                'error'   => false,
                'message' => trans( 'auth.logged_out' )
            ] );
        } catch ( TokenExpiredException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.expired' )

            ], 401 );
        } catch ( TokenInvalidException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.invalid' )
            ], 401 );

        } catch ( JWTException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.missing' )
            ], 500 );
        }
    }
}
