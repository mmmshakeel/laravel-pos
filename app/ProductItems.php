<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductItems extends Model {

    use SoftDeletes;

    protected $table = 'product_items';
    protected $dates = ['deleted_at'];

    public function purchaseOrder() {
        return $this->belongsTo('App\PurchaseOrder', 'purchase_order_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
