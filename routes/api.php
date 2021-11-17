<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//
//    Route::post('add', [\App\Http\Controllers\API\UserDataController::class, 'add']);
//});


Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {

    Route::post('add', [\App\Http\Controllers\API\UserDataController::class, 'add']);
    Route::post('update/{id}', [\App\Http\Controllers\API\UserDataController::class, 'update']);
    Route::get('delete-teg/{teg_id}/{user_data_id}', [\App\Http\Controllers\API\UserDataController::class, 'deleteTeg']);
    Route::get('delete-user-data/{id}', [\App\Http\Controllers\API\UserDataController::class, 'deleteUserData']);
    Route::get('get-user-data', [\App\Http\Controllers\API\UserDataController::class, 'getUserData']);

});
