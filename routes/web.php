<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockReportController;


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
require __DIR__ . '/api.php';



//product routers
Route::get('/products', [ProductController::class, 'index'])->name('products.index');//displays a list of all products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');//shows the form to create a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');//receives form data from the "Add Product" page and stores a new product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');//deletes the product from the database.
Route::get('/products/{product}/stock-history', [ProductController::class, 'history'])->name('stock.history');//show stock history (ledger entry)via a button in product index page(action field)
//Route::get('/products', [ProductController::class, 'showHistory'])->name('showHistory');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');//open product edit form when click edit button
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');//update the product detail when click update

//order routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');//displays Orders Index page
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');//shows the "Place Order" form in dashboard(in a button)
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');//receives the submitted order form and saves the new order

//purchase routes
Route::get('/purchases/create',[PurchaseController::class, 'create'])->name('purchases.create');//display purchases create page(in the product create page)
Route::post('/purchases',[PurchaseController::class,'store'])->name('purchases.store');//store product qty to stockLedger 

//stock report
Route::get('/stock-report', [StockReportController::class, 'index'])->name('report.create');//generate stock report  
Route::get('/reports/stock/pdf', [StockReportController::class, 'exportPdf'])->name('reports.stock.pdf');//download report pdf
