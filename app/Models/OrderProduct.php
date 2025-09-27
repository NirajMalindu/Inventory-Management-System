<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products'; // pivot table eka
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    // Belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
