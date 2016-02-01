<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';
    protected $dates = ['deleted_at'];

    public function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function model() {
        return $this->belongsTo('App\ProductModel', 'model_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function product_type() {
        return $this->belongsTo('App\ProductType', 'product_type_id');
    }

    public function inventory() {
        return $this->hasMany('App\Inventory', 'product_id');
    }

    public function branch() {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function productItems() {
        return $this->hasMany('App\ProductItems', 'product_id');
    }
}
