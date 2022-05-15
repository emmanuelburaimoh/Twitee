<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class MainController extends Controller
{
    public function welcome(){
        return view("main.welcome");
    }
    public function home(){
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', "=", Session::get('loginId'))->first();
        }
        return view("main.home", compact('data'));
    }
    public function twit(){
        echo "works";
    }
}
