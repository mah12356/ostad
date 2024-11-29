<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Mail\Mymail;
use Illuminate\Support\Facades\Session;


Route::get('/tf', function (){
    \Illuminate\Support\Facades\Mail::to('mhdijanati021@gmail.com')->send(new Mymail());
});
Route::get('/', function () {
    Session::put('name', [1,2]);
});
Route::get('/q', function () {

    print_r( Session::get('name'));
});
