<?php

use App\Http\Controllers\v1\LoginController;
use App\Http\Controllers\v1\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/login',LoginController::class);
    Route::get('/plan',PlanController::class);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
