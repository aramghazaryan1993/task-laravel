<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {

    Route::post('add', [\App\Http\Controllers\API\ProductController::class, 'add']);
    Route::post('update/{id}', [\App\Http\Controllers\API\ProductController::class, 'update']);
    Route::delete('delete-tag/{tag_id}/{product_id}', [\App\Http\Controllers\API\ProductController::class, 'deleteTag']);
    Route::delete('delete-product/{id}', [\App\Http\Controllers\API\ProductController::class, 'deleteProduct']);
    Route::get('get-all-product', [\App\Http\Controllers\API\ProductController::class, 'getAllProduct']);
    Route::get('get-all-tag', [\App\Http\Controllers\API\ProductController::class, 'getAllTag']);
});
