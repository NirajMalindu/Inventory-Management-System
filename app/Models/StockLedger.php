<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLedger extends Model
{
    protected $fillable = ['product_id','in','out','type','reference_id'];

    //belongs to one product
    public function product() {
        return $this->belongsTo(Product::class);
    }

    //one SockLedger belong to one purchase
    public function purchase(){
        return $this->belongsTO(Purchase::class);
    }
}

