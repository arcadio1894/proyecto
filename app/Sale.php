<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'state', 'type_doc', 'sale_date', 'comment'
    ];

    public function details(){
        return $this->hasMany('App\SaleDetail', 'sale_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    protected $dates = ['deleted_at'];
}
