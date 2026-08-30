<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [ApiController::class, 'logout']);
    Route::get('furniture', [ApiController::class, 'furniture']);
    Route::get('categories', [ApiController::class, 'categories']);
    Route::get('customers', [ApiController::class, 'customers']);
    Route::get('orders', [ApiController::class, 'orders']);
});
