<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\StockLedger;
use App\Models\Purchase;



use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //shows the "purchases create" form in product adding (in a button)
    public function create() {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    //to store the qty for products in stockLedger
    public function store(Request $request){
        
        //validate the purchases submit form
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'required',
        ]);

        //save values to purchase table as $purchase
        $purchase = Purchase::create([
            'supplier' => $request->supplier,
        ]);
        
        //save values to stockLedger table(when user add stock)
        stockLedger::create([
            'product_id' => $request->product_id,
            'in' => $request->quantity,
            'out' => 0,
            'type' =>'in',
            'reference_id' => $purchase->id,
        ]);

        return redirect()->route('products.index')->with('success','Your stock updated Successfully');
    }
}
