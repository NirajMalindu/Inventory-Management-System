<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'stock_quantity', 'price'];

    // Each product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

    // Product can belong to many orders (pivot table)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
