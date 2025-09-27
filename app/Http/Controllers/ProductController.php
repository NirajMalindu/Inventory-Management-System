<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');//Returns the Blade template (products.create)
    }

    public function store(Request $request) {
        //check validation part
        $request->validate([
            'name' => 'required',
            'category_name' => 'required', 
            'stock_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if category exists, if not, create it
        $category = Category::firstOrCreate([    //(firstOrCreate)Checks if a category with that name exists.
            'name' => $request->category_name]

        );

        //Creates a new product
        Product::create([
            'name' => $request->name,
            'category_id' => $category->id,
            'stock_quantity' => $request->stock_quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }



    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
