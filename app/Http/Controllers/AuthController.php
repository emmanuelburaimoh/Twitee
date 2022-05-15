<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function registration(){
        return view("auth.registration");
    }
    public function registerUser(Request $request){
        $request -> validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = new User();
        $user -> name = substr($request->email, 0, strrpos($request->email, '@'));
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $res = $user -> save();
        if($res){
            return redirect('/home');
        }else {
            return back() -> with('failed', 'Registration failed');
        }
    }
    public function loginUser(Request $request){
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $user = User::where('email', "=", $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('/home');
            } else {
                return back() -> with('failed', 'Wrong password');
            }
        }else {
            return back() -> with('failed', 'User not found');
        }
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/');
        }
    }
}
