<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function users(){
        return $this->hasMany('App\User', 'role_id');
    }

    protected $dates = ['deleted_at'];
}
