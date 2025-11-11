<?php

use App\Http\Controllers\UrlShortnerController;
use App\Http\Services\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/shortned',[UrlShortnerController::class,'save']);

Route::get('/{url}',[UrlShortnerController::class,'redirect']);