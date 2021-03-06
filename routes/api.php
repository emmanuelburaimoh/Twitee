<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;

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

Route::group(['middleware'=>'api','prefix'=>'auth'], function($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('authDone');
    Route::get('/profile', [AuthController::class, 'profile'])->middleware('authCheck');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/twit', [MainController::class, 'twit'])->middleware('authCheck');
    Route::post('/twit-comment', [MainController::class, 'twitComment'])->middleware('authCheck');
    Route::get('/twits', [MainController::class, 'twits'])->middleware('authCheck');
    Route::delete('/twit-delete/{id}', [MainController::class, 'twitDelete'])->middleware('authCheck');
});