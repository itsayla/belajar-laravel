<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return response()->json(['message'=>'API HAS RUN!']);
});

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('user', \App\Http\Controllers\API\UserController::class);
    Route::post('logout', [\App\Http\Controllers\API\LoginController::class, 'logout'])->name('logout');
});
