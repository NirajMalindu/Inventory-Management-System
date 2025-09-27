<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
            if($qty>0){
                $product = Product::findOrFail($productId);

                if($product->stock_quantity < $qty) 
                    return back()->with('error',"Not enough stock for {$product->name}");

                //deducts the ordered quantity from the product’s stock and saves the change
                $product->stock_quantity -= $qty; 
                $product->save();

                $order->products()->attach($productId,['quantity'=>$qty]);
                $total += $product->price * $qty;
            }
        }

        $order->update(['total'=>$total]);//after processing all products, updates the order total.
        return redirect()->route('orders.index')->with('success','Order placed successfully!');
    }
}
