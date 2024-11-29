<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\MasterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'ostad'], function (){
    Route::post('/signup',[AuthControllers::class,'signup']);
    Route::post('/login',[AuthControllers::class,'login']);
    Route::post('/skill',[MasterController::class,'skill']);
    Route::post('/masters', [MasterController::class,'masters']);
    Route::patch('/request',[AuthControllers::class,'userrequest']);
    Route::patch('/neg',[AuthControllers::class,'neg']);
});
