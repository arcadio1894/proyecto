<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'money', 'color', 'image', 'comment', 'state', 'stock',
        'category_id', 'brand_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    protected $dates = ['deleted_at'];
}
