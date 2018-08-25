<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'price_unit', 'quantity'
    ];

    public function sale(){
        return $this->belongsTo('App\Sale');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

}
