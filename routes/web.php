<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//product routers
Route::get('/products', [ProductController::class, 'index'])->name('products.index');//displays a list of all products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');//shows the form to create a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');//receives form data from the "Add Product" page and stores a new product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');//deletes the product from the database.

//order routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');//displays Orders Index page
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');//shows the "Place Order" form in dashboard(in a button)
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');//receives the submitted order form and saves the new order
