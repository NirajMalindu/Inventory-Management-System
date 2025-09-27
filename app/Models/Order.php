<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total'];

    // Each order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One order has many pivot entries
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // Shortcut to access products directly
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
