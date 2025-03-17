<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);
Route::post('verifyOtp',[AuthController::class, 'verifyOtp']);

Route::get('getAllCities/{id}',[CommonController::class, 'getAllCities']);
Route::get('getAllStates',[CommonController::class, 'getAllStates']);

Route::middleware('auth:sanctum')->group(function(){


    Route::get('getUserDetail/{id}',[AuthController::class, 'getUserDetail']);
    Route::post('updateUserDetail',[AuthController::class, 'updateUserDetail']);

    Route::get('getAllBrand',[CommonController::class, 'getAllBrand']);
    Route::get('get_AllCategory',[CommonController::class, 'getAllCategory']);
    Route::get('get_AllGroupValue',[CommonController::class, 'getAllGroupValue']);
    Route::get('getAllProductType',[CommonController::class, 'getAllProductType']);
    Route::get('getAllUnit',[CommonController::class, 'getAllUnit']);

    Route::get('getSupplierCatgory',[CommonController::class, 'getSupplierCatgory']);

    Route::get('getAllProduct',[ProductsController::class, 'getAllProduct']);
    Route::post('addProduct',[ProductsController::class, 'addProduct']);


});
