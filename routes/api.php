<?php

use App\Http\Controllers\v1\BaseController;
use App\Http\Controllers\v1\InvoiceController;
use App\Http\Controllers\v1\LoginController;
use App\Http\Controllers\v1\LogoutController;
use App\Http\Controllers\v1\PaymentController;
use App\Http\Controllers\v1\PDFController;
use App\Http\Controllers\v1\PlanController;
use App\Http\Controllers\v1\RegisterController;
use App\Http\Controllers\v1\SectionController;
use App\Http\Controllers\v1\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::get('/plan',PlanController::class);
    Route::post('/login',LoginController::class);
    Route::get('/login',[BaseController::class,'unauthenticated'])->name('login');
    Route::post('/register',RegisterController::class);
    Route::prefix('payment')->controller(PaymentController::class)->group(function () {
        Route::get('webhook','payment_webhook')->name('payment.webhook');
    });
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout',LogoutController::class);
        Route::prefix('subscription')->controller(SubscriptionController::class)->group(function () {
            Route::get('/','index');
            Route::post('/','store');
        });
        Route::middleware(['checkSubscription'])->group(function () {
            Route::prefix('section')->controller(SectionController::class)->group(function () {
                Route::get('/','index');
            });
            Route::prefix('invoice')->controller(InvoiceController::class)->group(function () {
                Route::get('/','index');
                Route::get('/search/{subscription}','store');
            });
            Route::prefix('invoice')->controller(PDFController::class)->group(function () {
                Route::get('/{subscription}/download','download');
            });
        });
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
