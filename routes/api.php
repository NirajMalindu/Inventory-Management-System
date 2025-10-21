<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockController;
use App\Models\Product;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//To get history of stockLedger
Route::get('/products/{product}/stock-History', [StockController::class, 'history']);
