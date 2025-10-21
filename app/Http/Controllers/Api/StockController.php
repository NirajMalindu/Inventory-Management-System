<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class StockController extends Controller
{
   
    public function history(Product $product){
        $history = $product->stockLedgers()->orderBy('created_at', 'desc')->get();
        return response()->json($history);
    }
}

