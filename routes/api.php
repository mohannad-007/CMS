<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::prefix('/al_naweia')->group(function ()
//{
//    Route::get('/getMyProfile',[UserController::class,'getMyProfile']);
//
//});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('/al_naweia')->group(function () {
        Route::get('/getMyProfile',[UserController::class,'getMyProfile']);

    });
});
