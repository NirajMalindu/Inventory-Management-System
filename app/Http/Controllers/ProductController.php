<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request) {

        $query = Product::with('category');

        //get user search input product from product and category table
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        $products = $query->get();

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
            'price' => $request->price,
        ]);

        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }



    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }



    //to show the stock history clicking history button in product action field
    public function history($id, Request $request){

        $product = Product::with('category')->findOrFail($id);
        
        //get filter and sorting input from the url
        $type = $request->input('type');//it takes 'in', 'out', 'nul'
        $query = $product->stockLedgers();

        //filter by type
        if($type){
            $query->where('type', $type);
        }

        $sort = $request->input('sort', 'desc');//'asc' or 'desc'
        //apply sorting by created_at
        $entries = $query->orderBy('created_at', $sort)->get();

        return view('products.stock_history', compact('product','entries','type','sort'));
    }

    // Show edit page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    
    // Handle update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


}
