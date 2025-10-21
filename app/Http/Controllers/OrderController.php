<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\StockLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//provides access to the currently authenticated user

class OrderController extends Controller
{
    //display a list of orders for the currently logged-in user
    public function index() {
        $orders = Order::with('products')->where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }


    //shows the "Place Order" form in dashboard(in a button)
    public function create() {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request) {

        //validate the submitted order form.
        $request->validate([
            'products' => 'required|array'
        ]);

        //creates a new order in the database
        $order = Order::create([
            'user_id'=>auth()->id(),
            'status'=>'pending',
            'total'=>0
        ]);

        $total = 0;
        foreach($request->products as $productId=>$qty){
            //when user enter the quantity (request) in order a product this check it is grater than 0
            if($qty>0){
                $product = Product::findOrFail($productId);

                //check user requested qty is grater than than product stock(calculate from stockLedgers()->sum('in')-sum('out'))
                if($product->current_stock < $qty) //($product->current_stock )to get stock dynamically
                    return back()->with('error',"Not enough stock for {$product->name}");

                //save values to stock_ledgers table
                StockLedger::create([
                    'product_id' => $product->id,
                    'in' => 0,
                    'out' => $qty,
                    'type' =>'out',
                    'reference_id' => $order->id,
                ]);

                $order->products()->attach($productId,['quantity'=>$qty]);
                $total += $product->price * $qty;
            }
        }

        $order->update(['total'=>$total]);//after processing all products, updates the order total.
        return redirect()->route('orders.index')->with('success','Order placed successfully!');
    }
}
