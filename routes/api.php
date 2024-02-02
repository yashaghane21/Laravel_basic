<?php

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the medisage tech team'], 200);
});

Route::post('/signup', [Auth::class, 'Reg']);
Route::post('/login', [Auth::class, 'login']);
Route::get('/getusers', [Auth::class, 'getallusers']);
Route::get('/getbyid', [Auth::class, 'getuserbyid']);
