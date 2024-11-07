<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutCompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkPlanController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/al_naweia')->group(function ()
{
    Route::get('/getMyProfile',[UserController::class,'getMyProfile']);
    Route::get('/getMyCompany',[CompanyController::class,'getMyCompany']);
    Route::get('/getlogo',[CompanyController::class,'getlogo']);
    Route::get('/getSliders',[CompanyController::class,'getSliders']);
    Route::get('/getSocialLink',[CompanyController::class,'getSocialLink']);
    Route::get('/getCompanyDetails',[CompanyController::class,'getCompanyDetails']);
    Route::get('/getWorkPlan',[WorkPlanController::class,'getWorkPlan']);
    Route::get('/WorkPlanInfo',[WorkPlanController::class,'WorkPlanInfo']);
    Route::get('/getService',[ServiceController::class,'getService']);
    Route::get('/getServiceInfo',[ServiceController::class,'getServiceInfo']);
    Route::get('/getAboutCompany',[AboutCompanyController::class,'getAboutCompany']);
    Route::get('/getAboutCompanyInfo',[AboutCompanyController::class,'getAboutCompanyInfo']);
    Route::get('/getAboutDetails',[AboutCompanyController::class,'getAboutDetails']);
    Route::post('/creatContactUs',[ContactUsController::class,'creatContactUs']);
});
