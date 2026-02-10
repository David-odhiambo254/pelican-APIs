<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ImageDescriptionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::resource('customers', 'CustomerController'); //CustomerController::class
    Route::resource('files', 'FileController'); //FileController::class
    Route::resource('orders', 'OrderController'); //OrderController::class

    Route::post('files/bulk', ['uses' => 'FileController@bulkStore']);

    Route::apiResource('image-descriptions', ImageDescriptionController::class)->only(['index', 'store']);
});
