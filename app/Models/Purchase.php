<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $fillable = ['supplier',];


    public function stockLedgers(){
        return $this->hasMany(StockLedger::class);
    }
}
