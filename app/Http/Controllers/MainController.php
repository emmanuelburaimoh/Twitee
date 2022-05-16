<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Twit;
use App\Models\TwitComment;
use Validator;

class MainController extends Controller
{
    public function welcome(){
        return view("welcome");
    }

    public function twit(Request $request){
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $twit = new Twit();
        $twit->body = $request->body;
        $request->user()->twit()->save($twit);
        return response()->json([
            'message'=>'Twited successfully',
            'twit'=>$twit
        ], 201);
    }

    public function twitComment(Request $request){
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $twit = new twitComment();
        $twit->body = $request->body;
        $twit->twit_id = $request->twit_id;
        $res = $twit->save();
        
        return response()->json([
            'message'=>'Twited successfully',
            'twit'=>$twit
        ], 201);
    }
}
