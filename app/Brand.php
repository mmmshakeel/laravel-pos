<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'brand';
    protected $dates = ['deleted_at'];

    public function models() {
        return $this->hasMany('App\ProductModel');
    }
}